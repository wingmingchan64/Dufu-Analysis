<?php
declare(strict_types=1);
namespace Dufu\Exceptions;
use RuntimeException;

class DSLoaderException extends RuntimeException{}
class IoException extends RuntimeException{}

class BaseDirNotFoundException extends DufuException{}
class JsonFileNotFoundException extends DufuException{}
class JsonReadException extends DufuException{}
class JsonDecodeException extends DufuException{}


?>