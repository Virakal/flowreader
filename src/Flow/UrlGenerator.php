<?php

namespace Flow;

class UrlGenerator
{
    public function generate($entity)
    {
        switch(get_class($entity)) {
            case 'Flow\Entities\Series':
                return '/' . $this->slug($entity->getSeries()->getName());
            case 'Flow\Entities\Chapter':
                return '/' . $this->slug($entity->getSeries()->getName())
                    . '/' . $entity->getChapterNo();
            default:
                throw new \InvalidArgumentException(
                    'Unrecognised object passed to URL Generator: ' . get_class($entity)
                );
        }
    }

    public function slug($text)
    {
        return preg_replace('[^\w\d]', '-', strtolower($text));
    }
}