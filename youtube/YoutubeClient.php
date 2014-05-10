<?php
require_once 'Google/Client.php';
require_once 'Google/Service/YouTube.php';
session_start();

const OAUTH2_CLIENT_ID = '788892358631-7qgnhih2vuu6qktnsofhnvkifbdodvqj.apps.googleusercontent.com';
const OAUTH2_CLIENT_SECRET = 'bx6xRMWuE2XJw0LnuhuQovTB';
// const OAUTH2_REDIRECT_URI = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
const OAUTH2_REDIRECT_URI = 'http://';

class YoutubeClient {
	private $client;
	private $youtube;

    public function __construct () {
        $this->client = new Google_Client();
		$this->client->setClientId(OAUTH2_CLIENT_ID);
		$this->client->setClientSecret(OAUTH2_CLIENT_SECRET);
		$this->client->setScopes('https://www.googleapis.com/auth/youtube');
		$this->client->setRedirectUri(filter_var(OAUTH2_REDIRECT_URI), FILTER_SANITIZE_URL);

		// Define an object that will be used to make all API requests.
		$this->youtube = new Google_Service_YouTube($this->client);

		if (isset($_SESSION['token'])) {
  			$this->client->setAccessToken($_SESSION['token']);
		}
    }

    public function createAuthURL() {
    	return $this->client->createAuthUrl();
    }

    public function showChannelList() {
    	
    	if ($this->client->getAccessToken()) {
		  
		  	try {
		    	// Call the channels.list method to retrieve information about the
		    	// currently authenticated user's channel.
		    	$channelsResponse = $this->youtube->channels->listChannels('contentDetails', array(
		      																					'mine' => 'true',
		    																				));
		    	$htmlBody = '';
		    	foreach ($channelsResponse['items'] as $channel) {
		      	// Extract the unique playlist ID that identifies the list of videos
		      	// uploaded to the channel, and then call the playlistItems.list method
		      	// to retrieve that list.
		      	$uploadsListId = $channel['contentDetails']['relatedPlaylists']['uploads'];

		      	$playlistItemsResponse = $this->youtube->playlistItems->listPlaylistItems('snippet', array(
		        	'playlistId' => $uploadsListId,
		        	'maxResults' => 50
		      	));

		      	$htmlBody .= "<h3>Videos in list $uploadsListId</h3><ul>";
		      	foreach ($playlistItemsResponse['items'] as $playlistItem) {
		        	$htmlBody .= sprintf('<li>%s (%s)</li>', $playlistItem['snippet']['title'], $playlistItem['snippet']['resourceId']['videoId']);
		      	}
		      		$htmlBody .= '</ul>';
		    	}
		  	} catch (Google_ServiceException $e) {
		    	$htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>', htmlspecialchars($e->getMessage()));

		    	return $htmlBody;
		  	} catch (Google_Exception $e) {
		  		$htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>', htmlspecialchars($e->getMessage()));

		    	return $htmlBody;
		  	}
		  	$_SESSION['token'] = $this->client->getAccessToken();

			return $htmlBody;
		} else {
		  	$state = mt_rand();
		  	$this->client->setState($state);
		  	$_SESSION['state'] = $state;

		  	$authUrl = $this->createAuthURL();
		  	$htmlBody = <<<END
		  	<h3>Authorization Required</h3>
		  	<p>You need to <a href="$authUrl">authorize access</a> before proceeding.<p>
END;
		
			return $htmlBody;
		}
    }
}

?>