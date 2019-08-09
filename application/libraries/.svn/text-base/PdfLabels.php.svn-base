<?php

include_once __DIR__ . '/tcpdf/tcpdf.php';

/**
 * Clase para geração de etiquetas personalizadas
 *
 * @link http://www.hufersil.com.br HUFERSIL.WEBDEVELOPER
 * @author Hugo Ferreira da Silva
 */
class PdfLabels extends TCPDF {
    /**
     * Largura da página
     * @var int
     */
    public $pageWidth = 216;

    /**
     * Altura da página
     * @var int
     */
    public $pageHeight = 279;

    /**
     * Largura da etiqueta
     * @var int
     */
    public $labelWidth = 102;

    /**
     * Altura da etiqueta
     * @var int
     */
    public $labelHeight = 34;

	/**
     * Margem do topo da página
     * @var int
     */
    public $marginTop = 21;

    /**
     * Margem da esquerda da página
     * @var int
     */
    public $marginLeft = 5;

    /**
     * Margem da direita da página
     * @var int
     */
    public $marginRight = 5;

	/**
     * Espaço vertical entre etiquetas
     * @var int
     */
    public $verticalSpace = 2;

    /**
     * Espaço horizontal entre etiquetas
     * @var int
     */
    public $horizontalSpace = 5;

	/**
     * Número de colunas por página
     * @var int
     */
    public $maxColumnsPerPage = 2;

    /**
     * Número de linhas por página
     * @var int
     */
    public $maxRowsPerPage = 7;

	/**
     * Se é para desenhar ou não as bordas das etiquetas
     * @var int
     */
    public $drawBorders = 1;

    /**
     * Mapeamento dos campos para geração das etiquetas
     * @var array
     */
    protected $fieldMap = array();

	/**
     * Estilos para geração de códigos de barras
     * @var int
     */
    public $barcodeStyles = array(
        'position' => '',
        'align' => 'C',
        'stretch' => false,
        'fitwidth' => true,
        'cellfitalign' => '',
        'border' => false,
        'hpadding' => 1,
        'vpadding' => 'auto',
        'fgcolor' => array(0,0,0),
        'bgcolor' => false, //array(255,255,255),
        'text' => false,
        'font' => 'helvetica',
        'fontsize' => 8,
        'stretchtext' => 4
    );

    /**
     * Só fazemos o override para omitir o header padrão da biblioteca
     * @see TCPDF::Header()
     */
    public function Header(){
    }

    /**
     * Só fazemos o override para omitir o footer padrão da biblioteca
     * @see TCPDF::Header()
     */
    public function Footer(){
    }

    /**
     * Inidica os campos a serem usados neste PDF
     *
     * @param array $map mapeamento dos campos
     * @author Hugo Ferreira da Silva
     * @return void
     */
    public function setFieldMap(array $map)
    {
        $this->fieldMap = array();
        foreach($map as $item){
            if(!($item instanceof PdfLabelField)){
                if(!is_array($item)) {
                    throw new InvalidArgumentException('O campo deve ser um array ou instancia de PdfLabelField');
                }

                $item = new PdfLabelField($item);
            }
            $this->addFieldToMap($item);
        }
    }

    /**
     * Retorna os elementos que compõe uma etiqueta
     *
     * @author Hugo Ferreira da Silva
     * @return array<PdfLabelField>
     */
    public function getFieldMap()
    {
        return $this->fieldMap;
    }

    /**
     * Adiciona um campo para exibir na etiqueta
     *
     * @param PdfLabelField $field
     * @author Hugo Ferreira da Silva
     * @return void
     */
    public function addFieldToMap(PdfLabelField $field)
    {
        $this->fieldMap[] = $field;
    }

    /**
     * Método que gera o PDF com as etiquetas
     *
     * @param array $data
     * @author Hugo Ferreira da Silva
     * @return
     */
    public function drawLabels(array $data)
    {
        $this->validateParameters();
        $this->SetAutoPageBreak(false);
        $this->SetMargins($this->marginLeft, $this->marginTop, $this->marginRight, true);

        $column = 0;
        $row = 0;
        $total = count($data);
        $current = 1;

        $this->AddPage($this->pageWidth > $this->pageHeight ? 'L' : 'P', array($this->pageWidth,$this->pageHeight));

        foreach($data as $rowData){
            $x = $this->marginLeft + ($column * ($this->horizontalSpace + $this->labelWidth));
            $y = $this->marginTop + ($row * ($this->verticalSpace + $this->labelHeight));

            $this->drawLabel($rowData, $x, $y);
            $current++;

            $column++;
            if($column == $this->maxColumnsPerPage){
                $column = 0;
                $row++;
                if($row == $this->maxRowsPerPage && $current <= $total){
                    $this->AddPage($this->pageWidth > $this->pageHeight ? 'L' : 'P', array($this->pageWidth,$this->pageHeight));
                    $row = 0;
                }
            }
        }
    }

    /**
     * Desenha uma etiqueta
     *
     * @param array $row
     * @param int $x
     * @param int $y
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function drawLabel( $row, $x, $y){
        if($this->drawBorders == 1){
            $this->MultiCell($this->labelWidth, $this->labelHeight, '', $this->drawBorders, 0, false, 0, $x, $y);
        }
        /* @var $field PdfLabelField */
        foreach($this->fieldMap as $field){
            $this->SetAbsXY($x + $field->getX(), $y + $field->getY());
            $this->SetFont($field->getFont(),$field->getStyle(),$field->getSize());

            if(trim($field->getbarcode()) == '') {
                $width = $this->GetStringWidth($row[$field->getDataField()].' ');
                if($field->getAlign() == 'C'){
                    $xt = $x + $field->getX() + $this->GetStringWidth($field->getDataField())/2 - $width/2;
                    $this->SetAbsX($xt);
                }
                if($field->getAlign() == 'R'){
                    $xt = $x + $field->getX() + $this->GetStringWidth($field->getDataField()) - $width;
                    $this->SetAbsX($xt);
                }
                $this->Cell($width,0,$row[$field->getDataField()]);
            } else {
                $this->write1DBarcode($row[$field->getDataField()], $field->getBarcode(), '', '', $field->getWidth(), $field->getHeight(), '', $this->barcodeStyles);
            }

        }
    }

    /**
     * Valida se os parametros enviados para gerar as etiquetas são válidos
     *
     * @throws InvalidArgumentException
     * @author Hugo Ferreira da Silva
     * @return boolean
     */
    protected function validateParameters()
    {
        $listNonEmpty = array('pageWidth',
        	'pageHeight',
            'labelWidth',
            'labelHeight',
            'maxColumnsPerPage',
            'maxRowsPerPage',
        );

        foreach($listNonEmpty as $item)
        {
            if(!is_numeric($this->$item) || $this->$item <= 0){
                throw new InvalidArgumentException('Valor inválido para "'.$item.'"');
            }
        }

        if(empty($this->fieldMap))
        {
            throw new InvalidArgumentException('Nenhum campo para compor as etiquetas');
        }

        return true;
    }
}

class PdfLabelField {
    protected $x;
    protected $y;
    protected $dataField;
    protected $align;
    protected $width;
    protected $height;
    protected $barcode;
    protected $style;
    protected $size;
    protected $font;

    public function __construct(array $data=array())
    {
        $this->setFromArray($data);
    }

    public function setFromArray(array $values)
    {
        foreach($values as $key => $value)
        {
            if(method_exists($this, 'set'.ucfirst($key))) {
                $this->{'set'.ucfirst($key)}($value);
            }
        }
    }

    // auto-generated getters/setters
    /**
     *
     * @return
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     *
     * @param $x
     */
    public function setX($x)
    {
        $this->x = $x;
    }

    /**
     *
     * @return
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     *
     * @param $y
     */
    public function setY($y)
    {
        $this->y = $y;
    }

    /**
     *
     * @return
     */
    public function getDataField()
    {
        return $this->dataField;
    }

    /**
     *
     * @param $dataField
     */
    public function setDataField($dataField)
    {
        $this->dataField = $dataField;
    }

    /**
     *
     * @return
     */
    public function getAlign()
    {
        return $this->align;
    }

    /**
     *
     * @param $align
     */
    public function setAlign($align)
    {
        $this->align = $align;
    }

    /**
     *
     * @return
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     *
     * @param $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     *
     * @return
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     *
     * @param $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     *
     * @return
     */
    public function getBarcode()
    {
        return $this->barcode;
    }

    /**
     *
     * @param $barcode
     */
    public function setBarcode($barcode)
    {
        $this->barcode = $barcode;
    }

    /**
     *
     * @return
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     *
     * @param $style
     */
    public function setStyle($style)
    {
        $this->style = $style;
    }

    /**
     *
     * @return
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     *
     * @param $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     *
     * @return
     */
    public function getFont()
    {
        return $this->font;
    }

    /**
     *
     * @param $font
     */
    public function setFont($font)
    {
        $this->font = $font;
    }
}

/* End of file PdfLabels.php */
/* Location: PdfLabels.php */