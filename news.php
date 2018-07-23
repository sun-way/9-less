<?php
date_default_timezone_set('UTC');
class NewsList
{
    private static $newsCount = 0;
    private $newsArray = [];
    public function addNews($news)
    {
        if (empty($news) || !($news instanceof News)) {
            return false;
        }
        $news->id = ++self::$newsCount;
        return $this->newsArray[] = $news;
    }
    public function getAllNews()
    {
        return $this->newsArray;
    }
    public function getNewsCount()
    {
        return count($this->newsArray);
    }
}
class News
{
    private static $commentsCount = 0;
    private $title;
    private $text;
    private $comments = [];
    public function __construct($title, $text)
    {
        $this->title = $title;
        $this->text = $text;
    }
    public function getContent()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'text' => $this->text,
        ];
    }
    public function addComment($comment)
    {
        if (empty($comment) || !($comment instanceof Comment)) {
            return false;
        }
        $comment->id = ++self::$commentsCount;
        return $this->comments[] = $comment;
    }
    public function getComments()
    {
        return $this->comments;
    }
    public function getCommentsCount()
    {
        return count($this->comments);
    }
}
class Comment
{
    private $author;
    private $text;
    private $timestamp;
    public function __construct($author, $text)
    {
        $this->author = $author;
        $this->text = $text;
        $this->timestamp = date('d-m-y H:i:s');
    }
    public function getContent()
    {
        return [
            'id' => $this->id,
            'author' => $this->author,
            'text' => $this->text,
            'timestamp' => $this->timestamp,
        ];
    }
}
$newsList = new NewsList();
$weather = new News(
    'The clouds are blue',
    'Hello, write something about it.....'
);
$weather->addComment(new Comment(
    'Lucy',
    'It`s great.'
));
$weather->addComment(new Comment(
    'Olga',
    'Yehhh. I love summer '
));
$weather->addComment(new Comment(
    'Ivan',
    'Its rain a-a-a-a-a.....'
));

$flowerNews = new News(
    'Роза – один из наиболее обожаемых и прославленных цветов на планете.  ',
    'Собственным возникновением розы обогнали человечество так на 34 миллиона лет. 
     Обнаружены архаические организмы роз, ориентирующие на возрастные рамки ориентировочно 50 миллионов лет.
     Цивилизованной розе приблизительно 5000 лет. Сегодня всеизвестно ориентировочно 300 разновидностей роз и 30000 сортов.'
);
$flowerNews->addComment(new Comment(
    'Любитель',
    'Люди, систематически вдыхающие благоухание розы, активизируют расположение вокруг себя, обладают светлой ровной аурой, благожелательны.'
));
$hotNews = new News(
    'Мудрость',
    'Думайте о прошлом лишь тогда, когда оно будит одни приятные воспоминания'
);
$newsList->addNews($weather);
$newsList->addNews($flowerNews);
$newsList->addNews($hotNews);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Новости</title>
</head>
<body>

<?php foreach ($newsList->getAllNews() as $news): ?>
    <?php $newsContent = $news->getContent(); ?>

    <h2>
        <?php echo $newsContent['title']; ?>
    </h2>

    <p>
        <?php echo $newsContent['text']; ?>
    </p>

    <?php $newsCommentsCount = $news->getCommentsCount(); ?>

    <?php if($newsCommentsCount): ?>
        <p>
            Всего комментариев:
            <?php echo $newsCommentsCount; ?>
        </p>
        <ul>
            <?php $comments = $news->getComments(); ?>

            <?php foreach ($comments as $comment): ?>
                <li>
                    <?php $commentContent = $comment->getContent(); ?>

                    <h5>
                        Автор: <?php echo $commentContent['author']; ?>
                        <h5>

                            <h6>
                                Время: <?php echo $commentContent['timestamp']; ?>
                                <h6>

                                    <p>
                                        <?php echo $commentContent['text']; ?>
                                    </p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif;?>

<?php endforeach; ?>
</body>
</html>