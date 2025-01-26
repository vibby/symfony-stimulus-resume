<?php

namespace App\Entity;

trait JsonDeserializable{
    public function jsonSerialize(): array {
        return get_object_vars($this);
    }

    public static function jsonDeserialize(mixed $json)
    {
        $className = get_called_class();
        if (is_string($json)) {
            $json = json_decode($json, true);
            foreach ($json as $key => $value) {
                if (is_array($value) && array_keys($value) === ['date', 'timezone_type', 'timezone']) {
                    $json[$key] = new \DateTime($value['date'], new \DateTimeZone($value['timezone']));
                }
            }
        }
        $classInstance = new $className(...$json);

        foreach ($json as $key => $value) {
            if (!property_exists($classInstance, $key)) continue;

            $classInstance->{$key} = $value;
        }

        return $classInstance;
    }
}
