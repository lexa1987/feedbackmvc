<?php

namespace feedback\lib;

/**
 * Класс типов файлов
 *
 * @author Lexa
 */
class TypeFile {
    
    protected $arrAllowType;
    
    function __construct(array $arrAllowType) {
        $this->arrAllowType = $arrAllowType;
    }
    
    function getArrAllowType() {
        return $this->arrAllowType;
    }

    /**
     * Проверяет соответствует ли файл разрешеным типам
     * @param type $dataUrl
     * @return boolean
     */
    public function testTypeFile($dataUrl)
    {
        $ext = substr($dataUrl, strpos($dataUrl, ':')+1, strpos($dataUrl, ';')-strpos($dataUrl, ':')-1);
        if (array_search($ext, $this->arrAllowType)===FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
}
