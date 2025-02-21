<?php

namespace App\Enums;


/**
 * Author: Bekzod Raximov
 * Date: 20/02/2025
 * github: https://github.com/DeveloperBekzod
 * Email: devbekzod@gmail.com
 **/
enum QuestionTypeEnum: string
{
    case IMAGE = 'image';
    case VIDEO = 'video';
    case TEXT = 'text';
    case RADIO = 'radio';
    case MULTIPLE = 'multiple';
}
