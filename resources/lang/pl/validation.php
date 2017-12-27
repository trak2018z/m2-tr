<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Pole must be accepted.',
    'active_url'           => 'Pole is not a valid URL.',
    'after'                => 'Pole must be a date after :date.',
    'after_or_equal'       => 'Pole must be a date after or equal to :date.',
    'alpha'                => 'Pole may only contain letters.',
    'alpha_dash'           => 'Pole may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'Pole may only contain letters and numbers.',
    'array'                => 'Pole musi być tablicą.',
    'before'               => 'Pole must be a date before :date.',
    'before_or_equal'      => 'Pole must be a date before or equal to :date.',
    'between'              => [
        'numeric' => 'Pole must be between :min and :max.',
        'file'    => 'Pole must be between :min and :max kilobytes.',
        'string'  => 'Pole must be between :min and :max characters.',
        'array'   => 'Pole must have between :min and :max items.',
    ],
    'boolean'              => 'Pole field must be true or false.',
    'confirmed'            => 'Pole confirmation does not match.',
    'date'                 => 'Pole is not a valid date.',
    'date_format'          => 'Pole does not match the format :format.',
    'different'            => 'Pole and :other must be different.',
    'digits'               => 'Pole must be :digits digits.',
    'digits_between'       => 'Pole must be between :min and :max digits.',
    'dimensions'           => 'Pole has invalid image dimensions.',
    'distinct'             => 'Pole field has a duplicate value.',
    'email'                => 'Pole must be a valid email address.',
    'exists'               => 'Pole zawiera niepoprawną wartość.',
    'file'                 => 'Pole must be a file.',
    'filled'               => 'Pole field must have a value.',
    'longitude'            => 'Wybrane miejsce leży poza dozwolonym obszarem',
    'image'                => 'Pole must be an image.',
    'in'                   => 'Pole zawiera niepoprawną wartość.',
    'in_array'             => 'Pole field does not exist in :other.',
    'integer'              => 'Pole musi byc liczbą całkowitą.',
    'ip'                   => 'Pole must be a valid IP address.',
    'ipv4'                 => 'Pole must be a valid IPv4 address.',
    'ipv6'                 => 'Pole must be a valid IPv6 address.',
    'json'                 => 'Pole must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'Pole nie może być większe niż :max.',
        'file'    => 'Pole nie może być większe niż :max kilobytes.',
        'string'  => 'Pole nie może być większe niż :max characters.',
        'array'   => 'Pole may not have more than :max items.',
    ],
    'mimes'                => 'Pole must be a file of type: :values.',
    'mimetypes'            => 'Pole must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'Pole must be at least :min.',
        'file'    => 'Pole must be at least :min kilobytes.',
        'string'  => 'Pole must be at least :min characters.',
        'array'   => 'Pole must have at least :min items.',
    ],
    'not_in'               => 'Wybrana wartość jest niepoprawna.',
    'numeric'              => 'Pole must be a number.',
    'phone'                => 'Pole zawiera niepoprawny numer telefonu.',
    'present'              => 'Pole musi być zawarte w zapytaniu.',
    'regex'                => 'Pole ma niepoprawny format.',
    'required'             => 'Pole jest wymagane.',
    'required_if'          => 'Pole jest wymagane ,gdy :other is :value.',
    'required_unless'      => 'Pole jest wymagane unless :other is in :values.',
    'required_with'        => 'Pole jest wymagane ,gdy :values jest obecne.',
    'required_with_all'    => 'Pole jest wymagane ,gdy :values jest obecne.',
    'required_without'     => 'Pole jest wymagane ,gdy :values is not present.',
    'required_without_all' => 'Pole jest wymagane ,gdy none of :values are present.',
    'same'                 => 'Pole and :other must match.',
    'size'                 => [
        'numeric' => 'Pole must be :size.',
        'file'    => 'Pole must be :size kilobytes.',
        'string'  => 'Pole must be :size characters.',
        'array'   => 'Pole must contain :size items.',
    ],
    'string'               => 'Pole musi być tekstem.',
    'timezone'             => 'Pole must be a valid zone.',
    'unique'               => 'Pole has already been taken.',
    'uploaded'             => 'Pole failed to upload.',
    'url'                  => 'Pole format is invalid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
