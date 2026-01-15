<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    */

    'accepted' => ':attribute qabul qilinishi kerak.',
    'active_url' => ':attribute haqiqiy URL emas.',
    'after' => ':attribute :date dan keyingi sana bo\'lishi kerak.',
    'alpha' => ':attribute faqat harflardan iborat bo\'lishi kerak.',
    'alpha_dash' => ':attribute faqat harflar, raqamlar, tire va pastki chiziqdan iborat bo\'lishi kerak.',
    'alpha_num' => ':attribute faqat harflar va raqamlardan iborat bo\'lishi kerak.',
    'array' => ':attribute massiv bo\'lishi kerak.',
    'before' => ':attribute :date dan oldingi sana bo\'lishi kerak.',
    'between' => [
        'numeric' => ':attribute :min va :max orasida bo\'lishi kerak.',
        'file' => ':attribute :min va :max kilobayt orasida bo\'lishi kerak.',
        'string' => ':attribute :min va :max belgi orasida bo\'lishi kerak.',
        'array' => ':attribute :min va :max element orasida bo\'lishi kerak.',
    ],
    'boolean' => ':attribute true yoki false bo\'lishi kerak.',
    'confirmed' => ':attribute tasdiqlanmadi.',
    'date' => ':attribute haqiqiy sana emas.',
    'date_format' => ':attribute :format formatiga mos kelmaydi.',
    'different' => ':attribute va :other bir xil bo\'lmasligi kerak.',
    'digits' => ':attribute :digits raqamdan iborat bo\'lishi kerak.',
    'digits_between' => ':attribute :min va :max raqam orasida bo\'lishi kerak.',
    'email' => ':attribute haqiqiy email manzil bo\'lishi kerak.',
    'exists' => 'Tanlangan :attribute noto\'g\'ri.',
    'file' => ':attribute fayl bo\'lishi kerak.',
    'filled' => ':attribute to\'ldirilishi kerak.',
    'image' => ':attribute rasm bo\'lishi kerak.',
    'in' => 'Tanlangan :attribute noto\'g\'ri.',
    'integer' => ':attribute butun son bo\'lishi kerak.',
    'ip' => ':attribute haqiqiy IP manzil bo\'lishi kerak.',
    'json' => ':attribute haqiqiy JSON qator bo\'lishi kerak.',
    'max' => [
        'numeric' => ':attribute :max dan katta bo\'lmasligi kerak.',
        'file' => ':attribute :max kilobaytdan katta bo\'lmasligi kerak.',
        'string' => ':attribute :max belgidan ko\'p bo\'lmasligi kerak.',
        'array' => ':attribute :max elementdan ko\'p bo\'lmasligi kerak.',
    ],
    'mimes' => ':attribute :values tipidagi fayl bo\'lishi kerak.',
    'min' => [
        'numeric' => ':attribute kamida :min bo\'lishi kerak.',
        'file' => ':attribute kamida :min kilobayt bo\'lishi kerak.',
        'string' => ':attribute kamida :min belgi bo\'lishi kerak.',
        'array' => ':attribute kamida :min element bo\'lishi kerak.',
    ],
    'not_in' => 'Tanlangan :attribute noto\'g\'ri.',
    'numeric' => ':attribute raqam bo\'lishi kerak.',
    'regex' => ':attribute formati noto\'g\'ri.',
    'required' => ':attribute to\'ldirilishi shart.',
    'required_if' => ':other :value bo\'lganda :attribute to\'ldirilishi shart.',
    'required_with' => ':values mavjud bo\'lganda :attribute to\'ldirilishi shart.',
    'required_with_all' => ':values mavjud bo\'lganda :attribute to\'ldirilishi shart.',
    'required_without' => ':values mavjud bo\'lmaganda :attribute to\'ldirilishi shart.',
    'same' => ':attribute va :other bir xil bo\'lishi kerak.',
    'size' => [
        'numeric' => ':attribute :size bo\'lishi kerak.',
        'file' => ':attribute :size kilobayt bo\'lishi kerak.',
        'string' => ':attribute :size belgi bo\'lishi kerak.',
        'array' => ':attribute :size element bo\'lishi kerak.',
    ],
    'string' => ':attribute matn bo\'lishi kerak.',
    'timezone' => ':attribute haqiqiy vaqt mintaqasi bo\'lishi kerak.',
    'unique' => ':attribute allaqachon band qilingan.',
    'url' => ':attribute formati noto\'g\'ri.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
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
    */

    'attributes' => [
        'name' => 'ism',
        'email' => 'email',
        'password' => 'parol',
        'login' => 'login',
        'phone' => 'telefon',
        'role' => 'rol',
        'status' => 'holat',
    ],
];
