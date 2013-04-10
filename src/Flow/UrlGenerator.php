<?php

namespace Flow;

class UrlGenerator
{
    public function generate($entity)
    {
        switch(get_class($entity)) {
            case 'Flow\Entities\Series':
                return '/' . $entity->getSlug();
            case 'Flow\Entities\Chapter':
                return '/' . $entity->getSeries()->getSlug()
                     . '/' . $entity->getChapterNo();
            case 'Flow\Entities\Page':
                return '/' . $entity->getChapter()->getSeries()->getSlug()
                     . '/' . $entity->getChapter()->getChapterNo()
                     . '/' . $entity->getPageNo();
            default:
                throw new \InvalidArgumentException(
                    'Unrecognised object passed to URL Generator: ' . get_class($entity)
                );
        }
    }
}