<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use OhMyBrew\ShopifyApp\Models\Shop;

class AfterAuthenticateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $shopify;
    private  $api;

    public function __construct(Shop $shopify)
    {
        $this->shopify = $shopify;
        $this->api = $shopify->api();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->add_snippet();
    }

    /**
     * add snippet liquid to theme
     */
    public function add_snippet(){

        $themes = $this->api->rest('GET','/admin/themes.json')->body->themes;
        $theme_id = '';
        foreach ($themes as $theme){
            if ( $theme->role == 'main' ){
                $theme_id = $theme->id;
            }
        }

        if ( $theme_id === '' || $theme_id == NULL){
            return;
        }

        if ( !$this->check_snippets('snippets/dattq.liquid', $theme_id) ){
            //create new file
            $this->api->rest('PUT', "/admin/themes/$theme_id/assets.json", [
                "asset" => [
                    "key" => "snippets/dattq.liquid",
                    "value" => "<p>We are busy updating the store for you and will be back within the hour.</p>"
                ]
            ]);
        }
    }

    /**
     * Check if snippets is in the list.
     *
     * @param string $snippet The path to the asset within a theme. It consists of the file's directory and filename
     * For example, the asset assets/bg-body-green.gif is in the assets directory, so its key is assets/bg-body-green.gif.
     *
     * @return bool
     */
    public function check_snippets( $snippet, $theme_id ){
        $template = $this->api->rest('GET',"/admin/themes/$theme_id/assets.json?asset[key]=$snippet");
        if($template){
            return true;
        }
        return false;

    }
}
