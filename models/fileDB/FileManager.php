<?php

namespace models\fileDB;


/**
 * Class FileManager
 * @package models\fileDB
 */
class FileManager
{
    protected const PATH = 'filestore/';
    protected const FILE_FORMAT = '.csv';

    /**
     * @param string $filename
     * @param string $data
     * @return bool
     * @throws \Exception
     */
    public static function addRow(
        string $filename,
        string $data
    ): bool
    {
        $fullPath = self::getFilePath($filename);

        if (file_exists($fullPath)) {
            $file = fopen($fullPath, 'a');
            if (flock($file, LOCK_EX)) {
                fwrite($file, $data . PHP_EOL);
                flock($file, LOCK_UN);
            } else {
                throw new \Exception('lock is unavailable');
            }
            $result = fclose($file);
        }

        return $result ?? false;
    }

    /**
     * @param string $filename
     * @param string $uniqTitle
     * @param $uniqValue
     * @return array
     * @throws \Exception
     */
    public static function getRow(
        string $filename,
        string $uniqTitle,
        $uniqValue
    ): array
    {
        if (file_exists(self::getFilePath($filename))) {
            $filedata = (new CSVParser(self::getFilePath($filename)))->getCSVData();
            foreach ($filedata as $id => $row) {
                if (array_key_exists($uniqTitle, $row)) {
                    if ($row[$uniqTitle] === $uniqValue) {
                        $result = $row;
                        break;
                    }
                } else {
                    throw new \Exception('undefined column name');
                }
            }

            return $result ?? [];
        } else {
            throw new \Exception('file is not exist');
        }
    }

    /**
     * @param string $filename
     * @param array $structure
     * @return bool
     * @throws \Exception
     */
    public static function createFileIfNotExist(
        string $filename,
        array $structure
    ): bool
    {
        if (!file_exists(self::PATH)) {
            mkdir(self::PATH);
        }

        $fullPath = self::getFilePath($filename);
        if (!file_exists($fullPath)) {
            $file = fopen($fullPath, 'x');
            if (flock($file, LOCK_EX)) {
                fwrite($file, implode(',', $structure) . PHP_EOL);
                flock($file, LOCK_UN);
            } else {
                throw new \Exception('lock is unavailable');
            }

            $result = fclose($file);
        }

        return $result ?? true;
    }

    /**
     * @param string $filename
     * @return string
     */
    private static function getFilePath(string $filename): string
    {
        return self::PATH . DIRECTORY_SEPARATOR . $filename . self::FILE_FORMAT;
    }
}
