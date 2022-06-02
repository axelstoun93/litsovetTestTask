<?php
namespace App\Component\BookParser\Helper;

use App\Models\BookChapters;

class BookPageSeparator
{

    public $bookId;

    public function getPageChapter($bookId,$bookChapters)
    {
        $chapterArray = [];

        $chapterSize = strlen($bookChapters->getContent());
        $pageSize = 0;

        while ($chapterSize > $pageSize) {
            $content = substr($bookChapters->getContent(), $pageSize);
            $page = $this->separatorChapterPage($content);

            $chapterTitle = ($pageSize === 0) ? $bookChapters->getTitle() : null;

            array_push($chapterArray, [
                'chapter_title' => $chapterTitle,
                'content' => $page,
                'chapter_id' => $bookChapters->getId(),
                'book_id' => $bookId,
            ]);

            $pageSize = $pageSize + strlen($page);
        }

        return $chapterArray;
    }


    private function separatorChapterPage($text, $countText = 600, $delimiter = ' ')
    {
        $words = explode($delimiter, $text);

        if (count($words) > $countText) {
            $text = implode($delimiter, array_slice($words, 0, $countText));
        }

        return $text;
    }


}
