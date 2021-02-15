<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use App\Moel\PostRepository;
use Nette\Application\UI\Form;

class PostPresenter extends Nette\Application\UI\Presenter{

    private $database;

    public function __construct(PostRepository $database)
    {
        $this->database = $database;
    }

    public function renderGet($page = 3)
    {

        $postCount = $this->database->getPostsCount();

        $paginator = new Nette\Utils\Paginator;
        $paginator->setItemCount($postCount);
        $paginator->setItemsPerPage(2);
        $paginator->setPage($page);

        $posts = $this->database->getAllPosts($paginator->getLength(), $paginator->getOffset());

        $this->template->posts = $posts;

        $this->template->paginator = $paginator;
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
            '?'  => 'jiná',
        ];

        $form = new Form();

        $form->addText('name','name')
            ->setCaption('Zadejte jmeno')
            ->setRequired('Vyplnte prosim jmeno');
        $form->addTextArea('description','description')
            ->setCaption('Zadejte popis')
            ->setRequired('Vyplnte prosim popis');
        $form->addSelect('gender','gender', [
            'male' => 'Muž',
            'female' => 'Žena'
        ])
            ->setRequired('Zvolte prosim sve pohlavi');
        $form->addMultiSelect('countries', 'Země:', $countries);
        $form->addCheckboxList('question','Kolik je 1 + 1',[0,1,2]);

        $form->addSubmit('send','Odeslat');

        $form->onSuccess[] = [$this, 'addPostSucceeded'];

        return $form;

    }

    public function addPostSucceeded(Form $form, $values)
    {

        $this->database->insertPost([
            'name' => $values->name,
            'description' => $values->description,
            'gender' => $values->gender,
            'country' => implode(' ',$values->countries),
            'question' => implode(' ', $values->question)
        ]);
    }
}