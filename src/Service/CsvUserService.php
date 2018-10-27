<?php
/**
 * @author Bartłomiej Olewiński <bartlomiej.olewinski@gmail.com>
 */

namespace App\Service;

class CsvUserService extends FileUserServiceAbstract
{
    const PATH = '/var/data/testtakers.csv';
    const FORMAT = 'csv';

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->rootDir.self::PATH;
    }

    /**
     * @return string
     */
    public function getFormat(): string
    {
        return self::FORMAT;
    }
}
