
<?php

return [

    /* ===================================== */
    /* PERSONAL INFORMATION */
    /* ===================================== */

    'name' => 'John Lloyd A. Oresca',

    'role' => 'Developer / Designer / IT Graduate',

    'intro' => 'I build practical systems and explore
        creative digital experiences through
        development, design, and technology.',

    'email' => 'johnlloydoresca6@gmail.com',

    /* ===================================== */
    /* EDUCATION */
    /* ===================================== */

    'education' => [
        'degree' => 'Bachelor of Science in Information Technology',
        'school' => 'Camarines Norte State College',
        'years' => '2022 - 2026',
    ],

    /* ===================================== */
    /* PROJECTS */
    /* ===================================== */

    'projects' => [

        /* --------------------------------- */
        /* PROJECT 01: BREAKTHROUGH */
        /* --------------------------------- */

        [
            'slug' => 'breakthrough',

            'title' => 'Breakthrough Publication Portal',

            'category' => 'Web Development',

            'description' => 'A responsive school publication
                website supporting content accessibility
                and management.',

            'technologies' => [
                'Web Design',
                'Frontend Development',
            ],

            // Main image shown on portfolio homepage
            'image' => 'images/projects/breakthrough.png',

            // Screenshots on the project details page
            'gallery' => [
                [
                    'image' => 'images/projects/breakthrough.png',
                    'caption' => 'Breakthrough Publication Portal',
                ],
                [
                    'image' => 'images/projects/breakthroughfrontpage.png',
                    'caption' => 'Administrator Panel',
                ],
            ],
        ],

        /* --------------------------------- */
        /* PROJECT 02: ECO PLUG */
        /* --------------------------------- */

        [
            'slug' => 'eco-plug',

            'title' => 'ECO PLUG',

            'category' => 'IoT / Hardware',

            'description' => 'A smart plug system for
                real-time energy monitoring and remote
                power control.',

            'technologies' => [
                'IoT',
                'Microcontrollers',
            ],

            'image' => 'images/projects/eco-plug.webp',

            'gallery' => [],
        ],

        /* --------------------------------- */
        /* PROJECT 03: SMART KEY */
        /* --------------------------------- */

        [
            'slug' => 'smart-key',

            'title' => 'Smart Key Management System',

            'category' => 'Systems Development',

            'description' => 'An automated RFID key
                management system with monitoring
                and activity logging.',

            'technologies' => [
                'RFID',
                'Systems Development',
            ],

            'image' => 'images/projects/smart-key.webp',

            'gallery' => [],
        ],

        /* --------------------------------- */
        /* PROJECT 04: PAYROLL SYSTEM */
        /* --------------------------------- */

        [
            'slug' => 'payroll-system',

            'title' => 'Leave & Payroll Management System',

            'category' => 'Web Application',

            'description' => 'A system developed to
                support organizational leave and
                payroll workflows.',

            'technologies' => [
                'Information Systems',
                'Web Development',
            ],

            'image' => 'images/projects/payroll.webp',

            'gallery' => [],
        ],

    ],

    /* ===================================== */
    /* SKILLS */
    /* ===================================== */

    'skills' => [

        'Programming Languages' => [
            'PHP',
            'Python',
            'Java',
            'JavaScript',
            'C++',
        ],

        'Frameworks & Libraries' => [
            'Laravel',
            'React',
            'Bootstrap',
            'Tailwind CSS',
        ],

        'Databases' => [
            'mySQL',
            'PostgreSQL',
            'SQLite',
            'MongoDB',
            'Firebase',
        ],

        'Design & Animation' => [
            'Figma',
            'Canva',
            'Blender',
            '3ds Max',
            'Unreal Engine 5',
            'Adobe Photoshop',
            'Adobe Illustrator',
            'Adobe After Effects',
        ],

        'Hardware & Other Technologies' => [
            'IoT',
            'Hardware Diagnostics',
            'Technical Support',
        ],

    ],

];
