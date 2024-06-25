<?php

return [
    'navs' => [
        [
            'name' => 'Dashboard',
            'route_name' => 'dashboard',
            'iconify' => 'typcn:home'
        ],
        [
            'name' => 'Pengguna',
            'route_name' => 'pengguna',
            'iconify' => 'fa-solid:users'
        ],
        [
            'name' => 'Mata Pelajaran',
            'route_name' => 'mata-pelajaran',
            'iconify' => 'bxs:book'
        ],
        [
            'name' => 'Ujian',
            'route_name' => 'ujian',
            'iconify' => 'healthicons:i-exam-multiple-choice'
        ],
        [
            'name' => 'Record',
            'route_name' => 'record',
            'iconify' => 'icon-park-solid:log'
        ],
        [
            'name' => 'Enrolls',
            'route_name' => 'enrolls',
            'iconify' => 'mdi:book-plus-multiple'
        ]
    ],
    'headers' => [
        'dashboard' => [
            'name' => 'Dashboard',
            'iconify' => 'typcn:home'
        ],
        'pengguna' => [
            'name' => 'List Pengguna',
            'iconify' => 'fa-solid:users'
        ],
        'mata-pelajaran' => [
            'name' => 'List Mata Pelajaran',
            'iconify' => 'bxs:book',
        ],
        'ujian' => [
            'name' => 'List Ujian',
            'iconify' => 'healthicons:i-exam-multiple-choice'
        ],
        'tambah-mapel' => [
            'name' => 'Tambah Mata Pelajaran',
            'iconify' => 'bxs:book'
        ],
        'record' => [
            'name' => 'Admin Records',
            'iconify' => 'icon-park-solid:log'
        ],
        'enrolls' => [
            'name' => 'User Enrolls',
            'iconify' => 'mdi:book-plus-multiple'
        ]
    ],
    'grades' => [
        'Kelas 10',
        'Kelas 11',
        'Kelas 12'
    ],
    'majors' => [
        'Teknik Komputer Jaringan',
        'Informatika'
    ],
    'curricula' => [
        'Kurikulum Merdeka'
    ],
    'evaluations' => [
        'Kuis',
        'UTS',
        'UAS'
    ],
    'questions' => [
        'Pilihan Ganda',
        'Drag and Drop'
    ],
    'jumlahSoal' => [
        'Kuis' => 4,
        'UTS' => 12,
        'UAS' => 20
    ]
];
