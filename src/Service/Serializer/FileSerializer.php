<?php
/**
 * @author Bartłomiej Olewiński <bartlomiej.olewinski@gmail.com>
 */

namespace App\Service\Serializer;

use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class FileSerializer extends Serializer
{

    /**
     * FileSerializer constructor.
     */
    public function __construct()
    {
        $encoders = array(
            new JsonEncoder(),
            new CsvEncoder()
        );
        $normalizers = array(
            new ObjectNormalizer(),
            new ArrayDenormalizer()
        );

        parent::__construct($normalizers, $encoders);
    }
}
