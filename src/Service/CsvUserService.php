<?php
/**
 * @author Bartłomiej Olewiński <bartlomiej.olewinski@gmail.com>
 */

namespace App\Service;


use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Encoder\EncoderInterface;

class CsvUserService extends FileUserServiceAbstract
{
    const PATH = __DIR__.'/../../var/data/testtakers.csv';
    const FORMAT = 'csv';

    /**
     * path to file with data
     * @return string
     */
    function getPath(): string
    {
        return self::PATH;
    }

    /**
     * appropriate format/extension of file
     * i.r. 'csv', 'json', 'xml' etc
     * @return string
     */
    function getFormat(): string
    {
        return self::FORMAT;
    }

    /**
     * Encoder for Serializer
     * @return EncoderInterface
     */
    function getSerializerEncoder(): EncoderInterface
    {
        return new CsvEncoder();
    }
}