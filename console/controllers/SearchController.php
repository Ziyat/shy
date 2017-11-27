<?php

namespace console\controllers;

use backend\models\Episode;
use backend\models\Film;
use backend\models\Season;
use backend\models\Serial;
use box\services\search\FilmIndexer;
use Elasticsearch\Client;
use yii\console\Controller;
use yii\helpers\Console;
use const PHP_EOL;

class SearchController extends Controller
{

   private $indexer;
   private $client;

   public function __construct($id, $module, FilmIndexer $indexer, Client $client, $config = [])
   {
      parent::__construct($id, $module, $config);
      $this->indexer = $indexer;
      $this->client = $client;
   }

   public function actionReindex(): void
   {
      if ($this->testConnection()) {
         $this->stdout('Clearing' . PHP_EOL);
         $this->indexer->clear();

         $this->stdout('Indexing' . PHP_EOL);
         $this->index();
      }
   }

   public function actionInit(): void
   {
      if ($this->testConnection()) {
         $this->stdout('Indexing' . PHP_EOL);
         $this->index();
      }
   }

   public function actionDrop(): void
   {
      if ($this->testConnection()) {
         $this->stdout('Clearing' . PHP_EOL);
         $this->indexer->clear();
      }
   }

   public function testConnection(int $retryCount = 30, $timeOut = 10)
   {
      $this->stdout('Testing connection to Elastic Search' . PHP_EOL);

      for ($i = 0; $i < $retryCount; $i++) {
         $this->stdout('Ping Elastic Search ' . ($i + 1) . '/' . $retryCount . ' ');
         if ($this->client->ping()) {
//            $this->stdout(var_dump($this->client->info()) . PHP_EOL);
            $this->stdout('Connection established!' . PHP_EOL);
            sleep(1);
            return true;
         } else {
            $this->stdout('Connection reset. Retry after ' . $timeOut . ' seconds');
            for ($j = 0; $j < $timeOut; $j++) {
               $this->stdout('.');
               sleep(1);
            }
         }
      }

      $this->stdout(PHP_EOL . '--> Can`t connect to Elastic Search, you must manually index Elastic Search base!' . PHP_EOL, Console::BG_RED);
      return false;
   }

   private function index()
   {
      $this->stdout('Indexing of serials' . PHP_EOL);

      $serialQuery = Serial::find()->where(['is_public' => 1])->orderBy('id')->with('seasons');

      $total = Serial::find()->where(['is_public' => 1])->count();
      $i = 0;

      foreach ($serialQuery->each() as $serial) {
         $i++;
         $this->stdout('Serial id: ' . $serial->id . '___' . $i . '/' . $total . PHP_EOL);
         $this->indexer->indexSerial($serial);
      }

      $this->stdout(PHP_EOL . 'Done!' . PHP_EOL);

      $this->stdout('Indexing of films' . PHP_EOL);

      $filmQuery = Film::find()->where(['is_public' => 1])->orderBy('file_id');

      $total = Film::find()->where(['is_public' => 1])->count();
      $i = 0;

      foreach ($filmQuery->each() as $film) {
         $i++;
         $this->stdout('Film id: ' . $film->file_id . '___' . $i . '/' . $total . PHP_EOL);
         $this->indexer->indexFilm($film);
      }

      $this->stdout(PHP_EOL . 'Done!' . PHP_EOL);
   }

   public function actionViewsEpisodes(){

       $episodes = Episode::find()
           ->where(['is_public' => 1])
           ->orderBy('updated_at DESC')
           ->limit(5)
           ->asArray()
           ->all();
       $i=0;
       foreach ($episodes as $episode)
       {

           $episodes[$i]['season'] = Season::find()->with('serial')->where(['id' => $episode['season_id']])->asArray()->all();

           $i++;
       }

       var_dump($episodes);
   }

}