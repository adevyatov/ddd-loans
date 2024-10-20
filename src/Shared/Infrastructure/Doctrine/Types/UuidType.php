<?php
declare(strict_types=1);

namespace App\Shared\Infrastructure\Doctrine\Types;

use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\GuidType;
use Throwable;

class UuidType extends GuidType
{
    public const string NAME = 'uuid';

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?Uuid
    {
        if ($value instanceof Uuid) {
            return $value;
        }

        if (!is_string($value) || $value === '') {
            return null;
        }

        try {
            $uuid = new Uuid($value);
        } catch (Throwable $e) {
            throw ConversionException::conversionFailed($value, self::NAME, $e);
        }

        return $uuid;
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @throws ConversionException
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        if (
            $value instanceof Uuid
            || (
                (is_string($value)
                    || (is_object($value) && method_exists($value, '__toString')))
                && Uuid::isValid((string)$value)
            )
        ) {
            return (string)$value;
        }

        throw ConversionException::conversionFailed($value, self::NAME);
    }

    public function getName(): string
    {
        return self::NAME;
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function getMappedDatabaseTypes(AbstractPlatform $platform): array
    {
        return [self::NAME];
    }
}