<?php

namespace QuantaQuirk\Validation;

use QuantaQuirk\Contracts\Support\Arrayable;
use QuantaQuirk\Support\Traits\Macroable;
use QuantaQuirk\Validation\Rules\Can;
use QuantaQuirk\Validation\Rules\Dimensions;
use QuantaQuirk\Validation\Rules\Enum;
use QuantaQuirk\Validation\Rules\ExcludeIf;
use QuantaQuirk\Validation\Rules\Exists;
use QuantaQuirk\Validation\Rules\File;
use QuantaQuirk\Validation\Rules\ImageFile;
use QuantaQuirk\Validation\Rules\In;
use QuantaQuirk\Validation\Rules\NotIn;
use QuantaQuirk\Validation\Rules\ProhibitedIf;
use QuantaQuirk\Validation\Rules\RequiredIf;
use QuantaQuirk\Validation\Rules\Unique;

class Rule
{
    use Macroable;

    /**
     * Get a can constraint builder instance.
     *
     * @param  string  $ability
     * @param  mixed  ...$arguments
     * @return \QuantaQuirk\Validation\Rules\Can
     */
    public static function can($ability, ...$arguments)
    {
        return new Can($ability, $arguments);
    }

    /**
     * Create a new conditional rule set.
     *
     * @param  callable|bool  $condition
     * @param  array|string|\Closure  $rules
     * @param  array|string|\Closure  $defaultRules
     * @return \QuantaQuirk\Validation\ConditionalRules
     */
    public static function when($condition, $rules, $defaultRules = [])
    {
        return new ConditionalRules($condition, $rules, $defaultRules);
    }

    /**
     * Create a new nested rule set.
     *
     * @param  callable  $callback
     * @return \QuantaQuirk\Validation\NestedRules
     */
    public static function forEach($callback)
    {
        return new NestedRules($callback);
    }

    /**
     * Get a unique constraint builder instance.
     *
     * @param  string  $table
     * @param  string  $column
     * @return \QuantaQuirk\Validation\Rules\Unique
     */
    public static function unique($table, $column = 'NULL')
    {
        return new Unique($table, $column);
    }

    /**
     * Get an exists constraint builder instance.
     *
     * @param  string  $table
     * @param  string  $column
     * @return \QuantaQuirk\Validation\Rules\Exists
     */
    public static function exists($table, $column = 'NULL')
    {
        return new Exists($table, $column);
    }

    /**
     * Get an in constraint builder instance.
     *
     * @param  \QuantaQuirk\Contracts\Support\Arrayable|array|string  $values
     * @return \QuantaQuirk\Validation\Rules\In
     */
    public static function in($values)
    {
        if ($values instanceof Arrayable) {
            $values = $values->toArray();
        }

        return new In(is_array($values) ? $values : func_get_args());
    }

    /**
     * Get a not_in constraint builder instance.
     *
     * @param  \QuantaQuirk\Contracts\Support\Arrayable|array|string  $values
     * @return \QuantaQuirk\Validation\Rules\NotIn
     */
    public static function notIn($values)
    {
        if ($values instanceof Arrayable) {
            $values = $values->toArray();
        }

        return new NotIn(is_array($values) ? $values : func_get_args());
    }

    /**
     * Get a required_if constraint builder instance.
     *
     * @param  callable|bool  $callback
     * @return \QuantaQuirk\Validation\Rules\RequiredIf
     */
    public static function requiredIf($callback)
    {
        return new RequiredIf($callback);
    }

    /**
     * Get a exclude_if constraint builder instance.
     *
     * @param  callable|bool  $callback
     * @return \QuantaQuirk\Validation\Rules\ExcludeIf
     */
    public static function excludeIf($callback)
    {
        return new ExcludeIf($callback);
    }

    /**
     * Get a prohibited_if constraint builder instance.
     *
     * @param  callable|bool  $callback
     * @return \QuantaQuirk\Validation\Rules\ProhibitedIf
     */
    public static function prohibitedIf($callback)
    {
        return new ProhibitedIf($callback);
    }

    /**
     * Get an enum constraint builder instance.
     *
     * @param  string  $type
     * @return \QuantaQuirk\Validation\Rules\Enum
     */
    public static function enum($type)
    {
        return new Enum($type);
    }

    /**
     * Get a file constraint builder instance.
     *
     * @return \QuantaQuirk\Validation\Rules\File
     */
    public static function file()
    {
        return new File;
    }

    /**
     * Get an image file constraint builder instance.
     *
     * @return \QuantaQuirk\Validation\Rules\ImageFile
     */
    public static function imageFile()
    {
        return new ImageFile;
    }

    /**
     * Get a dimensions constraint builder instance.
     *
     * @param  array  $constraints
     * @return \QuantaQuirk\Validation\Rules\Dimensions
     */
    public static function dimensions(array $constraints = [])
    {
        return new Dimensions($constraints);
    }
}
