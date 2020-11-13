<?php
declare(strict_types=1);

namespace App\Service\Tmdb\Exceptions;
/**
 * Class InvalidMovieIdException
 * @package App\Service\Tmdb\Exceptions
 */
class InvalidMovieIdException extends \Cake\Core\Exception\Exception
{
    protected $_messageTemplate = 'Movie not found with id "%s"';
    protected $_defaultCode = 400;
}
