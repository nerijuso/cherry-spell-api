<?php

return [
    'menu' => [
        'logout' => 'Logout',
        'profile' => 'User profile',
    ],
    'aside' => [
        'users' => 'Users',
        'home' => 'Home',
        'funnels' => 'Funnels',
        'leads' => 'Leads',
        'quizzes' => 'Quizzes',
        'app_questions' => 'App questions',
        'file_manager' => 'File manager',
        'horizon' => 'Horizon',
        'adminer' => 'Adminer',
        'transactional_email' => 'Transactional emails',
        'subscriptions' => 'Subscriptions',
        'plans' => 'Plans',
    ],
    'button' => [
        'cancel' => 'Cancel',
        'submit' => 'Submit',
        'create' => 'Create',
        'update' => 'Update',
        'back' => 'Back',
        'remove_image' => 'Remove image',
    ],
    'page' => [
        'funnel' => [
            'content_header' => [
                'funnels' => 'Funnels',
                'create' => 'Create',
                'edit_funnel' => 'Edit funnel',
            ],
            'buttons' => [
                'create_funnel' => 'Create new funnel',
                'filter' => 'Filter',
                'edit' => 'Edit',
                'pages' => 'Pages',
            ],
            'form' => [
                'name' => 'Name',
                'quizzes' => 'Quizzes',
                'configuration' => 'Configuration in JSON',
                'is_active' => 'Is active',
            ],
            'content' => [
                'id' => 'ID',
                'name' => 'Name',
                'active' => 'Is active',
                'created_at' => 'Created at',
            ],
            'messages' => [
                'funnel_created' => 'Funnel was created successful!',
                'funnel_updated' => 'Funnel was updated successful!',
            ],
        ],
        'quiz' => [
            'content_header' => [
                'quizzes' => 'Quizzes',
                'create' => 'Create quiz',
                'edit_quiz' => 'Edit quiz',
                'answers' => 'Answers',
                'questions' => 'Questions',
                'question_options' => 'Question options',
            ],
            'form' => [
                'title' => 'Title',
                'description' => 'Description',
                'is_public' => 'Is public',
            ],
            'buttons' => [
                'create_quiz' => 'Create new quiz',
            ],
            'content' => [
                'name' => 'Name',
                'created_at' => 'Created at',
                'id' => 'ID',
                'yes' => 'Yes',
                'no' => 'No',
                'is_active' => 'Is active',
            ],
            'questions' => [
                'content_header' => [
                    'create' => 'Create new question',
                    'edit_question' => 'Edit question',
                ],
                'content' => [
                    'name' => 'Name',
                    'created_at' => 'Created at',
                    'updated_at' => 'Updated at',
                    'order' => 'Order',
                    'yes' => 'Yes',
                    'no' => 'No',
                    'is_active' => 'Is active',
                ],
                'form' => [
                    'question' => 'Question',
                    'order' => 'Order in the list (10, 20)',
                    'is_active' => 'Is active',
                    'remove_image' => 'Remove image',
                    'types' => 'Question type',
                ],
                'options' => [
                    'content_header' => [
                        'create' => 'Create new question option',
                        'edit_option' => 'Edit option',
                    ],
                    'content' => [
                        'option' => 'option',
                        'created_at' => 'Created at',
                        'updated_at' => 'Updated at',
                        'order' => 'Order',
                        'yes' => 'Yes',
                        'no' => 'No',
                        'is_active' => 'Is active',
                    ],
                    'form' => [
                        'option' => 'Option',
                        'order' => 'Order in the list (10, 20)',
                        'is_active' => 'Is active',
                        'remove_image' => 'Remove image',
                    ],
                ],
            ],
        ],
        'lead' => [
            'buttons' => [
                'email' => 'Filter by email',
                'email_placeholder' => 'Filter by email...',
            ],
            'content_header' => [
                'leads' => 'Leads',
                'view_lead' => 'View lead',
            ],
            'content' => [
                'id' => 'ID',
                'code' => 'Code',
                'email' => 'Email',
                'quiz' => 'Quiz',
                'funnel' => 'Funnel',
                'country' => 'Country',
                'user_id' => 'User ID',
                'user' => 'User',
                'quiz_answers' => 'Quiz answers',
                'created_at' => 'Created at',
                'updated_at' => 'Updated at',
            ],
        ],
        'app_question' => [
            'content_header' => [
                'app_questions' => 'All questions',
            ],
            'content' => [
                'id' => 'ID',
                'code' => 'Question',
                'created_at' => 'Created at',
            ],
        ],
        'subscription' => [
            'content_header' => [
                'subscriptions' => 'Subscriptions',
                'plans' => 'Subscription plans',
                'edit' => 'Edit subscription plan',
                'create' => 'Create subscription plan',
            ],
            'buttons' => [
                'filter' => 'Filter',
                'create_plan' => 'Create new plan'
            ],
            'form' => [
                'filter_by_name' => 'Filter by name',
                'name' => 'Name',
                'is_active' => 'Is active',
                'price' => 'Price',
                'old_price' => 'Old Price',
                'sort' => 'Sort (10, 20, 30...)',
                'is_popular' => 'Is popular',
                'is_hidden' => 'Is hidden',
            ],
            'messages' => [
                'subscription_plan_created' => 'Subscription plan created',
                'subscription_plan_updated' => 'Subscription plan updated'
            ],
            'content' => [
                'id' => 'ID',
                'name' => 'Name',
                'price' => 'Price',
                'user' => 'User name',
                'plan' => 'Plan',
                'is_active' => 'Is active',
                'yes' => 'Yes',
                'no' => 'No',
                'created_at' => 'Created at',
                'is_hidden' => 'Is hidden',
            ],
        ],
        'file_manager' => [
            'content_header' => [
                'file_manager' => 'File manager',
            ],
            'content' => [
                'current_path' => 'Current path',
                'backwards' => 'Backwards',
                'upload' => 'Upload',
                'confirm_remove' => 'Dou you really want to remove file :file?',
                'folder' => 'Folder',
                'file' => 'File',
                'file_name' => 'File name',
            ],
        ],
    ],
];
