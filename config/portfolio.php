
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | PERSONAL INFORMATION
    |--------------------------------------------------------------------------
    */

    'name' => 'John Lloyd A. Oresca',

    'role' => 'Developer / Designer / IT Graduate',

    'intro' => 'I build practical systems and explore
        creative digital experiences through
        development, design, and technology.',

    'email' => 'johnlloydoresca6@gmail.com',

    'education' => [
        'degree' => 'Bachelor of Science in Information Technology',
        'school' => 'Camarines Norte State College',
        'years' => '2022 - 2026',
    ],

    /*
    |--------------------------------------------------------------------------
    | PROJECTS
    |--------------------------------------------------------------------------
    */

    'projects' => [

        /*
        |--------------------------------------------------
        | 01. BREAKTHROUGH PUBLICATION PORTAL
        |--------------------------------------------------
        */

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

            // Thumbnail used on homepage.
            'image' => 'images/projects/breakthroughfrontpage.png',

            // Four screenshots for the slideshow.
            'gallery' => [

                [
                    'image' => 'images/projects/breakthroughfrontpage.png',
                    'caption' => 'Publication Homepage',
                ],

                [
                    'image' => 'images/projects/breakthrough.png',
                    'caption' => 'Content Management Interface',
                ],

                [
                    'image' => 'images/projects/breakthroughuser.png',
                    'caption' => 'User Interface',
                ],

                [
                    'image' => 'images/projects/breakthrough user.png',
                    'caption' => 'Additional User View',
                ],

            ],
        ],

        /*
        |--------------------------------------------------
        | 02. ECO PLUG / SMART HOME ANALYTICS
        |--------------------------------------------------
        */

        [
            'slug' => 'eco-plug',

            'title' => 'ECO PLUG / Smart Home Analytics',

            'category' => 'IoT / Hardware',

            'description' => 'A smart plug system for
                real-time energy monitoring and remote
                power control.',

            'technologies' => [
                'IoT',
                'Microcontrollers',
            ],

            // Thumbnail used on homepage.
            'image' => 'images/projects/smhanalytics.png',

            // Four screenshots for the slideshow.
            'gallery' => [

                [
                    'image' => 'images/projects/smhanalytics.png',
                    'caption' => 'Smart Home Analytics - Overview',
                ],

                [
                    'image' => 'images/projects/smhanalytics2.png',
                    'caption' => 'Smart Home Analytics - View 02',
                ],

                [
                    'image' => 'images/projects/smhanalytics3.png',
                    'caption' => 'Smart Home Analytics - View 03',
                ],

                [
                    'image' => 'images/projects/smhanalytics4.png',
                    'caption' => 'Smart Home Analytics - View 04',
                ],

            ],
        ],

        /*
        |--------------------------------------------------
        | 03. SMART KEY MANAGEMENT SYSTEM
        |--------------------------------------------------
        */

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

        /*
        |--------------------------------------------------
        | 04. LEAVE AND PAYROLL MANAGEMENT SYSTEM
        |--------------------------------------------------
        */

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

    /*
    |--------------------------------------------------------------------------
    | SKILLS
    |--------------------------------------------------------------------------
    */

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
