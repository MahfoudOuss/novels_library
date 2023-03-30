<?php

namespace App\Jobs;

use App\Models\Chapter;
use App\Models\Novel;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Goutte\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Laravel\Dusk\Browser;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Support\Facades\Validator;


class Scraping implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $start;
    protected $end;
    /**
     * Create a new job instance.
     */
    public function __construct(int $start, int $end)
    {
        $this->start = $start;
        $this->end = $end;
    }
    
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $client = new Client();
        $FailedNovel =[];
        $FailedScrapedNovel=[];
        $novelsLinks = [];

        $driver = RemoteWebDriver::create(
            'http://localhost:9515',
            DesiredCapabilities::chrome()
        );
        $browser = new Browser($driver);
        $browser->driver->manage()->window()->maximize();
        for ($page = $this->start; $page <= $this->end; $page++) {
            $url = "https://boxnovel.com/novel/page/{$page}/";
            $crawler = $client->request('GET', $url);


            $novelsLinks = [...$crawler->filter('.page-item-detail > .item-thumb > a')->each(function ($node) {
                return $node->attr('href');
            })];
            
        if (empty($novelsLinks)) {
            echo "no element in the page $this->start till $this->end";
        } else {

            foreach ($novelsLinks as $link) {

                try{
                    $novelcrawler = $client->request('GET', $link);
                    try {
                        
                        $title = $novelcrawler->filter('.post-title > h1')->text();
                    } catch (\InvalidArgumentException) {
                        $title = "novel_without title";
                    }
                    
                    try {
                        
                        $tags = $novelcrawler->filter('.tags-content > a')->text();
                        if(strlen(trim($tags)) == 0 ){

                            $tags = "web_novel";
                        }
                    } catch (\InvalidArgumentException ) {
                        $tags = "web_novel";
                    }
                    
                    try {
                        
                        $author = $novelcrawler->filter('.author-content > a')->text();
                        if(strlen(trim($author)) == 0 ){

                            $author = "UKNOWN";
                        }
                    } catch (\InvalidArgumentException ) {
                        $author = "UKNOWN";
                    }
                    
                    try {
                        
                        $getstatus = $novelcrawler->filter('.post-status > .post-content_item > .summary-content')->text();
                        if(strlen( intval($getstatus) ) == strlen($getstatus) || strlen(trim($getstatus)) == 0 ){
                            $status = "N/A";
                        }else{
                            $status = $getstatus;
                        }
                    } catch (\InvalidArgumentException ) {
                        $status = "N/A";
                    }
                    
                    try {
                        
                        $summary = implode('|', $novelcrawler->filter('.summary__content ')->children()->each(function ($node) {
                            return $node->text();
                        }));
                                        } catch (\InvalidArgumentException ) {
                        $summary =" No summary for this novel ";
                        
                    }
                    
                    try {
                        
                        $genre = implode('|', $novelcrawler?->filter('.genres-content > a')->each(function ($node) {
                            return $node->text();
                        }));                 
                        if(strlen(trim($genre)) == 0 ){

                            $tags = "UKNOWN";
                        }
                    } catch (\InvalidArgumentException ) {
                        $genre = "UKNOWN";
                    }
                    
                    try {
                        
                        $img_url = $novelcrawler->filter('.tab-summary >.summary_image >a>img ')->attr('data-src');
                        if (strlen(trim($img_url)) == 0) {
                            $img_url = "images/no_image.png";
                        }
                    } catch (\InvalidArgumentException ) {
                        $img_url = "images/no_image.png";
                    }
                                                          




                $novel = [
                    'title' => $title,
                    'tags' => $tags,
                    'author' => $author,
                    'status' => $status,
                    'genre' => $genre,
                    'summary' => $summary,
                    'url' => $img_url
                ];


                $validator1 = Validator::make($novel, [
                    'title' => 'required|string',
                    'tags' => 'required|string',
                    'author' => 'required|string',
                    'status' => 'required|string',
                    'genre' => 'required|string',
                    'summary' => 'required|string',
                    'url' => 'required|string',

                ]);
                


                if ($validator1->fails()) {

                    $FailedNovel[]=$link;
                    
                } else {
                    $addnovel = Novel::create($novel);
                }
                } catch(\InvalidArgumentException ){
                    $FailedScrapedNovel[]=$link;
                }

                
                try {
                    $browser->visit($link .'chapter-1/');
                    for ($j = 0; $j < 15; $j++) {
                        $chapterscont = $browser->attribute('.entry-header', 'data-chapter');
                        $extract = preg_split('/[^0-9]/', $chapterscont);
                        $number = end($extract);
                        $chapterContent = $browser->driver->executeScript("return document.querySelector('.text-left').textContent");
                        $chaptertrim = nl2br(trim($chapterContent));
                        $chapterIn = [
                            'novel_id' => $addnovel->id,
                            'nbr' => intval($number),
                            'content' => $chaptertrim,
                        ];
                        $validator2 = Validator::make($chapterIn, [
                            'novel_id' => 'required',
                            'nbr' => 'required|integer',
                            'content' => 'required|string',
                        ]);
                        if ($validator2->fails()) {
                            echo 'error while validating chapter';
                        } else {
                            Chapter::create($chapterIn);
                        }
    
                        if ($browser->seeLink('Next')) {
    
                            $browser->clickLink('Next')->waitFor('.reading-content');
                        } else {
                            break;
                        }
                    }
                } catch ( \Facebook\WebDriver\Exception\NoSuchElementException ) {
                    try {
                        
                        $browser->pause(1000)
                        ->click('.btn-reverse-order ')
                        ->pause(1000)
                        ->click('.wp-manga-chapter > a');
                    } catch (\Facebook\WebDriver\Exception\ElementClickInterceptedException) {
                        $browser->click('#btn-read-last');
                    }
                }
                
            }
        }

    }


}
}