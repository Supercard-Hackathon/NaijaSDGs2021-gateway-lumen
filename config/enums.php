<?php

return [
    'appointment_status'   =>  [
        'open'  =>  'open',
        'checked-in'  =>  'checked-in',
        'closed'  =>  'closed',
    ],
    'bill_type'   =>  [
        'billed'  =>  'billed',
        'not-billed'  =>  'not-billed',
    ],
    'care_type'   =>  [
        'inpatient'  =>  'inpatient',
        'outpatient'  =>  'outpatient',
        'both'  =>  'both',
    ],
    'form_fields'   =>  [
        'radio'  =>  'radio',
        'date'  =>  'date',
        'range'  =>  'range',
        'time'  =>  'time',
        'number'  =>  'number',
        'checkbox'  =>  'checkbox',
        'number'  =>  'number',
        'text'  =>  'text',
        'textarea'  =>  'textarea',
        'select'  =>  'select',
        'multi-select'  =>  'multi-select',
    ],
    'gender'   =>  [
        'male'  =>  'male',
        'female'  =>  'female',
    ],
    'retainer_category'   =>  [
        'self-sponsored'  =>  'fee-paying',
        'HMO'  =>  'private-insurance',
        'employer'  =>  'company-insurance',
    ],
    'upload_category'   =>  [
        'user_avatar'  =>  'user_avatar',
        'organization_logo'  =>  'organization_logo',
        'user_note'  =>  'user_note',
        'user_encounter'  =>  'user_encounter',
    ],
    'service_category'   =>  [
        'registration'  =>  'registration',
        'consultation'  =>  'consultation',
        'pharmacy'  =>  'pharmacy',
        'imaging'  =>  'imaging',
        'procedure'  =>  'procedure',
        'laboratory'  =>  'laboratory',
    ],
    'payment_category'   =>  [
        'deposit'  =>  'deposit',
        'invoice'  =>  'invoice',
    ],
    'stakeholder'   =>  [
        'user'  =>  'user',
        'retainer'  =>  'retainer',
        'vendor'  =>  'vendor',
        'branch'  =>  'branch',
    ],
    'discount_category'   =>  [
        'singular'  =>  'singular',
        'compound'  =>  'compound',
    ],
    'inventory_category'   =>  [
        'store'  =>  'store',
        'pharmacy'  =>  'pharmacy',
        'laboratory'  =>  'laboratory',
        'consumables'  =>  'consumables',
    ],
    'inventory_unit_type'   =>  [
        'tablet'  =>  'tablet',
        'capsule'  =>  'capsule',
        'bottle'  =>  'bottle',
        'unit'  =>  'unit',
    ],
    'strength_unit_type'   =>  [
        'mg'  =>  'mg',
        'g'  =>  'g',
        'ml'  =>  'ml',
        'l'  =>  'l',
    ],
    'service_state'   =>  [
        'triggered'  =>  'triggered',
        'payment-collected'  =>  'payment-collected',
        'payment-confirmed'  =>  'payment-confirmed',
        'delivered'  =>  'delivered',
    ],
    'waitlist_status'   =>  [
        'waiting'  =>  'waiting',
        'on-session'  =>  'on-session',
        'done'  =>  'done',
    ],
    'visit_status'   =>  [
        'new'  =>  'new',
        'old'  =>  'old',
        'none'  =>  'none',
    ],
    'visit_type'   =>  [
        'ocs'  =>  'ocs',
        'see-physician'  =>  'see-physician',
    ],
    // 'medication_period_type'   =>  [
    //     'hourly'  =>  'hourly',
    //     'daily'  =>  'daily',
    // ],
    // 'medication_duration_type'   =>  [
    //     'minutes'  =>  'minutes',
    //     'hours'  =>  'hours',
    //     'days'  =>  'days',
    //     'weeks'  =>  'weeks',
    //     'months'  =>  'months',
    //     'years'  =>  'years',
    // ],
    'medication_route'   =>  [
        'oral'  =>  'oral',
        'intraveneous'  =>  'intraveneous',
        'intramuscullar'  =>  'intramuscullar',
    ]
];