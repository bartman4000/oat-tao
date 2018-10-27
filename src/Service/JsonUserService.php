<?php
/**
 * @author Bartłomiej Olewiński <bartlomiej.olewinski@gmail.com>
 */

namespace App\Service;


use Symfony\Component\Serializer\Encoder\EncoderInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class JsonUserService extends FileUserServiceAbstract
{
    const PATH = __DIR__.'/../../var/data/testtakers.json';
    const FORMAT = 'json';

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
        return new JsonEncoder();
    }
}