<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use App\Moel\PostRepository;
use Nette\Application\UI\Form;

class PostPresenter extends Nette\Application\UI\Presenter
{

    private $database;

    public function __construct(PostRepository $database)
    {
        $this->database = $database;
    }

    public function renderGet($page = 1)
    {
        $paginator = new Nette\Utils\Paginator;
        $paginator->setItemsPerPage(5);

        $paginator->setPage($page);
        $_SESSION['page'] = $page;

        $this->template->paginator = $paginator;

        if (isset($_GET['keyword'])) {

            $_SESSION['filter_keyword'] = $_GET['keyword'];
            $_SESSION['filter_column'] = $_GET['column'];
        }

        if (isset($_SESSION['sort_type']) || isset($_SESSION['filter_keyword'])) {
            if (isset($_SESSION['sort_type'])) {

                $postCount = $this->database->getPostsCount();
                $paginator->setItemCount($postCount);

                if ($_SESSION['sort_type'] == 'ASC') {
                    $posts = $this->database->sortPostsAsc($_SESSION['sort_column'], $paginator->getLength(), $paginator->getOffset());
                } else {
                    $posts = $this->database->sortPostsDesc($_SESSION['sort_column'], $paginator->getLength(), $paginator->getOffset());
                }
            }
            if (isset($_SESSION['filter_keyword'])) {

                $postCount = $this->database->getPostsFilterCount($_SESSION['filter_column'], $_SESSION['filter_keyword']);
                $paginator->setItemCount($postCount);
                $posts = $this->database->filterPosts($_SESSION['filter_column'], $_SESSION['filter_keyword'], $paginator->getLength(), $paginator->getOffset());
                $this->template->posts = $posts;

            }
            if (isset($_GET['keyword']) && isset($_SESSION['sort_type'])) {
                if ($_SESSION['sort_type'] == 'ASC') {
                    $posts = $this->database->sortPostsAsc($_SESSION['filter_column'], $paginator->getLength(), $paginator->getOffset());
                } else {
                    $posts = $this->database->sortPostsDesc($_SESSION['sort_column'], $paginator->getLength(), $paginator->getOffset());
                }
            }
        } else {

            $postCount = $this->database->getPostsCount();
            $paginator->setItemCount($postCount);
            $posts = $this->database->getAllPosts($paginator->getLength(), $paginator->getOffset());

        }

        $this->template->posts = $posts;

    }

    protected function createComponentAddPostForm()
    {

        $countries = [
            'Europe' => [
                'CZ' => 'Česká Republika',
                'SK' => 'Slovensko',
                'GB' => 'Velká Británie',
            ],
            'CA' => 'Kanada',
            'US' => 'USA',
            '?' => 'jiná',
        ];

        $form = new Form();

        $form->addText('name', 'name')
            ->setCaption('Zadejte jmeno')
            ->setRequired('Vyplnte prosim jmeno');
        $form->addTextArea('description', 'description')
            ->setCaption('Zadejte popis')
            ->setRequired('Vyplnte prosim popis');
        $form->addSelect('gender', 'gender', [
            'male' => 'Muž',
            'female' => 'Žena'
        ])
            ->setRequired('Zvolte prosim sve pohlavi');
        $form->addMultiSelect('countries', 'Země:', $countries);
        $form->addCheckboxList('question', 'Kolik je 1 + 1', [0, 1, 2]);

        $form->addSubmit('send', 'Odeslat');

        $form->onSuccess[] = [$this, 'addPostSucceeded'];

        return $form;

    }

    public function addPostSucceeded(Form $form, $values)
    {

        $this->database->insertPost([
            'name' => $values->name,
            'description' => $values->description,
            'gender' => $values->gender,
            'country' => implode(' ', $values->countries),
            'question' => implode(' ', $values->question)
        ]);
    }

    public function handleSortPosts($column, $type)
    {
        $_SESSION['sort_type'] = $type;
        $_SESSION['sort_column'] = $column;

    }
}