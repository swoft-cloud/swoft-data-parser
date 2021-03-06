<?php declare(strict_types=1);

namespace Swoft\DataParser;

use RuntimeException;
use Swoft\DataParser\Contract\DataParserInterface;
use function function_exists;

/**
 * Class MsgPackParser
 *
 * @since 1.0
 */
class MsgPackParser implements DataParserInterface
{
    /**
     * @return bool
     */
    public static function isSupported(): bool
    {
        return function_exists('msgpack_pack');
    }

    /**
     * Class constructor
     *
     * @throws RuntimeException
     */
    public function __construct()
    {
        if (!self::isSupported()) {
            throw new RuntimeException("The php extension 'msgpack' is required!");
        }
    }

    /**
     * @param mixed $data
     *
     * @return string
     */
    public function encode($data): string
    {
        /** @noinspection PhpUndefinedFunctionInspection */
        return \msgpack_pack($data);
    }

    /**
     * @param string $data
     *
     * @return mixed
     */
    public function decode(string $data)
    {
        /** @noinspection PhpUndefinedFunctionInspection */
        return \msgpack_unpack($data);
    }
}
