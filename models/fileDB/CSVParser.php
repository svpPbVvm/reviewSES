<?php

namespace models\fileDB;


/**
 * Class CSVParser
 * @package models\fileDB
 */
class CSVParser
{
    /**
     * @var string|null
     */
    protected ?string $filePath;

    /**
     * @var string
     */
    protected string $separator;

    /**
     * @var string
     */
    protected string $enclosure;

    /**
     * @var string
     */
    protected string $escape;

    /**
     * CSVParser constructor.
     * @param string $filePath
     * @param string $separator
     * @param string $enclosure
     * @param string $escape
     */
    public function __construct(
        string $filePath,
        string $separator = ",",
        string $enclosure = '"',
        string $escape = "\\"
    )
    {
        $this->filePath = $filePath;
        $this->separator = $separator;
        $this->enclosure = $enclosure;
        $this->escape = $escape;
    }

    /**
     * @param bool $firstLineTitle
     * @return array
     */
    public function getCSVData(bool $firstLineTitle = true): array
    {
        if (is_file($this->filePath) && file_exists($this->filePath)) {
            $handle = fopen($this->filePath, "r");
            $iterator = 0;
            while ($fileData = fgetcsv($handle)) {
                if ($iterator++ === 0 && $firstLineTitle) {
                    $titles = $fileData;
                } else {
                    $data[] = $fileData;
                }
            }
            if ($titles && $data) {
                $resData = $this->prepareData($titles, $data);
            }
        }

        return $resData ?? [];
    }

    /**
     * @param array $titles
     * @param array $data
     * @return array
     */
    protected function prepareData(
        array $titles,
        array $data
    ): array
    {
        $i = 0;
        foreach ($data as $datum) {
            foreach ($datum as $key => $value) {
                $preparedData[$i][$titles[$key]] = $value;
            }
            $i++;
        }

        return $preparedData ?? [];
    }
}