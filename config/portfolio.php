
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

            'project_type' => 'School Publication System',

            'description' => 'A Laravel-based web platform
                designed for managing and presenting
                student publication content.',

            'overview' => 'Breakthrough Publication Portal
                is a web-based school publication system
                developed using the Laravel framework
                and PHP.

                The platform provides an organized
                environment for managing and presenting
                school publication materials, including
                news, literary works, sports, and
                entertainment content.

                It features an administrative interface
                for publication management and a
                reader-facing interface for accessing
                published materials.

                The project focuses on improving
                content organization, accessibility,
                and digital publication workflows.',

            'features' => [

                [
                    'title' => 'Content Management',
                    'description' => 'An administrative
                        interface for organizing
                        publication materials.',
                ],

                [
                    'title' => 'Administrator Dashboard',
                    'description' => 'A dedicated
                        dashboard for managing
                        publication content.',
                ],

                [
                    'title' => 'Publication Categories',
                    'description' => 'Organized sections
                        for news, sports, literary
                        works, entertainment, and
                        other publication materials.',
                ],

                [
                    'title' => 'Reader Interface',
                    'description' => 'A web interface
                        for accessing school
                        publication content.',
                ],

            ],

            'technologies' => [
                'Laravel',
                'PHP',
                'Web Development',
                'Content Management',
            ],

            'image' => 'images/projects/breakthroughfrontpage.png',

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

            'live_url' => null,
        ],

        /*
        |--------------------------------------------------
        | 02. ECOPLUG / SMART HOME ANALYTICS
        |--------------------------------------------------
        */

        [
            'slug' => 'eco-plug',

            'title' => 'ECOPLUG / Smart Home Analytics',

            'category' => 'IoT / Web Application',

            'project_type' => 'Capstone Project',

            'description' => 'An IoT-based smart energy
                monitoring and control system
                designed to track electricity usage
                and manage connected appliances.',

            'overview' => 'ECOPLUG is a capstone
                project that combines Internet of
                Things technology with a web-based
                analytics platform.

                The system is designed to monitor
                electricity consumption, provide
                energy usage information, and support
                remote appliance management.

                Its proposed capabilities include
                device scheduling, electricity cost
                estimation, energy alerts, and basic
                predictive analytics.

                The project focuses on improving
                energy awareness and supporting
                more efficient electricity usage
                within institutional environments.',

            'features' => [

                [
                    'title' => 'Energy Monitoring',
                    'description' => 'Monitoring
                        and visualization of
                        electricity usage.',
                ],

                [
                    'title' => 'Remote Device Control',
                    'description' => 'IoT-based remote
                        management of connected
                        electrical appliances.',
                ],

                [
                    'title' => 'Consumption Analytics',
                    'description' => 'Dashboard views
                        for understanding energy
                        usage and electricity costs.',
                ],

                [
                    'title' => 'Appliance Scheduling',
                    'description' => 'Scheduled device
                        operation and automatic
                        shutdown functionality
                        described in the project.',
                ],

                [
                    'title' => 'Energy Notifications',
                    'description' => 'Alerts and
                        reminders related to
                        appliance usage.',
                ],

                [
                    'title' => 'Predictive Analytics',
                    'description' => 'Basic forecasting
                        of future electricity
                        consumption patterns.',
                ],

            ],

            'technologies' => [
                'Internet of Things (IoT)',
                'Web Application',
                'Energy Monitoring',
                'Smart Devices',
                'Vercel Deployment',
            ],

            'image' => 'images/projects/smhanalytics.png',

            'gallery' => [

                [
                    'image' => 'images/projects/smhanalytics.png',
                    'caption' => 'Smart Home Analytics Dashboard',
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

            'live_url' => 'https://smarthomeanalytics-lime.vercel.app/',
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

            'project_type' => 'RFID-Based System',

            'description' => 'An automated RFID key
                management system with monitoring
                and activity logging.',

            'overview' => 'The Smart Key Management
                System is a systems development
                project focused on organizing
                key management through RFID
                technology.

                The project explores automated
                monitoring and activity logging
                for tracking key-related
                operations.',

            'features' => [],

            'technologies' => [
                'RFID',
                'Systems Development',
            ],

            'image' => 'images/projects/smart-key.webp',

            'gallery' => [],

            'live_url' => null,
        ],

        /*
        |--------------------------------------------------
        | 04. OPAG LEAVE & PAYROLL MANAGEMENT SYSTEM
        |--------------------------------------------------
        */

        [
            'slug' => 'payroll-system',

            'title' => 'OPAG Leave & Payroll Management System',

            'category' => 'Web Application / Information System',

            'project_type' => 'Administrative Management System',

            'description' => 'A Laravel-based web
                application developed to support
                employee leave management and
                payroll administration for OPAG.',

            'overview' => 'The OPAG Leave & Payroll
                Management System is a web-based
                information system developed
                using Laravel, PHP, MySQL,
                and Tailwind CSS.

                The project is designed to support
                administrative workflows involving
                employee information, leave
                management, and payroll processing.

                It brings related administrative
                tasks into a centralized system,
                helping organize employee records
                and streamline the management
                of leave and payroll information.

                MySQL provides relational database
                storage, while Laravel supports
                the server-side application
                structure and Tailwind CSS is
                used for interface styling.

                The project demonstrates the
                application of web development
                and database technologies to
                administrative information
                management.',

            'features' => [

                [
                    'title' => 'Employee Information',
                    'description' => 'Organization
                        of employee details and
                        related administrative
                        records.',
                ],

                [
                    'title' => 'Leave Management',
                    'description' => 'Management
                        of employee leave
                        information and related
                        administrative workflows.',
                ],

                [
                    'title' => 'Payroll Management',
                    'description' => 'Support
                        for organizing and
                        processing payroll-related
                        information.',
                ],

                [
                    'title' => 'Administrative Interface',
                    'description' => 'A centralized
                        web interface for
                        handling administrative
                        tasks.',
                ],

                [
                    'title' => 'Database Management',
                    'description' => 'MySQL-based
                        storage and organization
                        of system information.',
                ],

            ],

            'technologies' => [
                'Laravel',
                'PHP',
                'MySQL',
                'Tailwind CSS',
                'Java',
                'Web Development',
            ],

            // Main homepage project thumbnail.
            'image' => 'images/projects/opag1.png',

            // Five verified OPAG screenshots.
            'gallery' => [

                [
                    'image' => 'images/projects/opag1.png',
                    'caption' => 'OPAG System - Screenshot 01',
                ],

                [
                    'image' => 'images/projects/opag2.png',
                    'caption' => 'OPAG System - Screenshot 02',
                ],

                [
                    'image' => 'images/projects/opag3.png',
                    'caption' => 'OPAG System - Screenshot 03',
                ],

                [
                    'image' => 'images/projects/opag4.png',
                    'caption' => 'OPAG System - Screenshot 04',
                ],

                [
                    'image' => 'images/projects/opag5.png',
                    'caption' => 'OPAG System - Screenshot 05',
                ],

            ],

            'live_url' => null,
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
            'MySQL',
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
