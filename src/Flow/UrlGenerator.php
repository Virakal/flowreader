<?php

namespace Flow;

class UrlGenerator
{
    public function generate($entity)
    {
        if ($entity instanceof Entities\Series)
            return '/' . $entity->getSlug();
        if ($entity instanceof Entities\Chapter)
            return '/' . $entity->getSeries()->getSlug()
                 . '/' . $entity->getChapterNo();
        if ($entity instanceof Entities\Page)
            return '/' . $entity->getChapter()->getSeries()->getSlug()
                 . '/' . $entity->getChapter()->getChapterNo()
                 . '/' . $entity->getPageNo();

        throw new \InvalidArgumentException(
            'Unrecognised object passed to URL Generator: ' . get_class($entity)
        );
    }
}