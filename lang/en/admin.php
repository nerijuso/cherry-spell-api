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
        'ai_prompts' => 'AI prompts',
        'cms' => 'CMS',
        'posts' => 'Posts',
        'tags' => 'Tags',
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
                    'size_1x' => 'WEB image 1x',
                    'size_2x' => 'WEB image 2x',
                    'size_3x' => 'WEB image 3x',
                    'size_mobile_1x' => 'Mobile image 1x',
                    'size_mobile_2x' => 'Mobile image 2x',
                    'size_mobile_3x' => 'Mobile image 3x',
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
                        'size_1x' => 'WEB image 1x',
                        'size_2x' => 'WEB image 2x',
                        'size_3x' => 'WEB image 3x',
                        'size_mobile_1x' => 'Mobile image 1x',
                        'size_mobile_2x' => 'Mobile image 2x',
                        'size_mobile_3x' => 'Mobile image 3x',
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
                'edit' => 'Edit price for',
                'create' => 'Create price for',
            ],
            'buttons' => [
                'filter' => 'Filter',
                'create_plan' => 'Create new plan',
                'create_new_coupon' => 'Create new coupon',
                'remove_coupon' => 'Remove coupon',
            ],
            'form' => [
                'configuration' => 'Configuration json',
                'filter_by_name' => 'Filter by name',
                'name' => 'Name',
                'is_active' => 'Is active',
                'price' => 'Price',
                'old_price' => 'Old Price',
                'sort' => 'Sort (10, 20, 30...)',
                'highlighted_option' => 'Is highlighted',
                'is_hidden' => 'Is hidden (but able to buy)',
                'period' => 'Payment period',
                'select' => 'Select option',
                'type' => 'Type',
                'free_gift' => 'Assign free gift',
                'remove_image' => 'Remove image',
                'size_1x' => 'Image in Stripe',
                'promo_code' => 'Promo Code',
                'coupon_name' => 'Coupon name (visible for users)',
                'new_coupon' => 'New coupon',
                'percentage' => 'Percentage discount',
                'example' => 'JSON example',
            ],
            'messages' => [
                'subscription_plan_created' => 'Subscription plan created',
                'subscription_plan_updated' => 'Subscription plan updated',
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
                'period' => 'Payment period',
                'type' => 'Type',
                'promo_code' => 'Promo Code',
                'ref_id' => 'Ref ID',
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
        'ai_prompt' => [
            'content_header' => [
                'ai_prompts' => 'AI Prompts',
                'ai_prompt' => 'AI Prompt:',
            ],
            'content' => [
                'identifier' => 'Unique system identifier',
                'short_desc' => 'Short description',
                'updated_at' => 'Updated at',
                'alert_info' => 'Be careful updating prompt value. This will impact how system will generate response for the users!',
            ],
            'form' => [
                'identifier' => 'Unique system identifier',
                'short_desc' => 'Short description',
                'value' => 'Prompt content',
                'updated_at' => 'Updated at',
            ],
            'messages' => [
                'prompt_updated' => 'Prompt updated',
            ],
        ],
        'tags' => [
            'content_header' => [
                'index' => 'Tags',
                'create_new' => 'Create new tag',
                'edit' => 'Edit tag',
            ],
            'buttons' => [
                'filter_by_title' => 'Filter by title',
                'filter' => 'Filter',
                'create_tag' => 'Create tag',
            ],
            'content' => [
                'id' => 'ID',
                'is_active' => 'Is active',
                'title' => 'Name',
                'created_at' => 'Created at',
                'position' => 'Position',
                'yes' => 'Yes',
                'no' => 'No',
                'posts_count' => 'Posts count',
            ],
            'form' => [
                'identifier' => 'Unique system identifier',
                'short_desc' => 'Short description',
                'value' => 'Prompt content',
                'updated_at' => 'Updated at',
                'title' => 'Title',
                'is_active' => 'Is active',
                'position' => 'Position',
                'size_1x' => 'Image 1x',
                'size_2x' => 'Image 2x',
                'size_3x' => 'Image 3x',
                'remove_image' => 'Remove image',
            ],
            'messages' => [
                'tag_updated' => 'Tag was updated',
                'tag_created' => 'Tag was created',
            ],
        ],
        'posts' => [
            'content_header' => [
                'index' => 'Tags',
                'create_new' => 'Create new post',
                'edit' => 'Edit post',
            ],
            'buttons' => [
                'filter_by_title' => 'Filter by title',
                'filter' => 'Filter',
                'create_post' => 'Create post',
            ],
            'content' => [
                'id' => 'ID',
                'is_active' => 'Is active',
                'title' => 'Name',
                'created_at' => 'Created at',
                'position' => 'Position',
                'yes' => 'Yes',
                'no' => 'No',
                'tags' => 'Tags',
            ],
            'form' => [
                'identifier' => 'Unique system identifier',
                'short_desc' => 'Short description',
                'value' => 'Prompt content',
                'updated_at' => 'Updated at',
                'title' => 'Title',
                'is_active' => 'Is active',
                'position' => 'Position',
                'size_1x' => 'Image 1x',
                'size_2x' => 'Image 2x',
                'size_3x' => 'Image 3x',
                'remove_image' => 'Remove image',
                'content' => 'Content',
                'tags_alert' => 'Please save post before assigning the tag',
            ],
            'messages' => [
                'post_updated' => 'Post was updated',
                'post_created' => 'Post was created',
            ],
        ],
    ],
];
