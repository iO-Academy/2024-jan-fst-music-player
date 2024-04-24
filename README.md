# Description

This project created the back end 'API' for a music player app. It extracts artist, album and song data from a mySQL database and returns the required JSON to integrate with a supplied front end.
By tracking the number of times a song was played, the most popular albums can be displayed. Additional functionality includes the users ability to favourite a song and search for a specific song.
The project was built in an OOP style using PHP.

# Getting Started

**Installing**

Ensure you have the correct docker image by following the guide in [this]https://github.com/iO-Academy/docker-image repo

Clone this repo and rename using:

```
git clone git@github.com:iO-Academy/2024-jan-fst-music-player.git music-player-api
```

Import the database ```music_2024-04-09.sql``` into a database called music

Ensure database host, username and password details are correct in:

```
src/DatabaseConnector/DatabaseConnector.php
```

Clone the front end repo into the same directory

```
git@github.com:iO-Academy/music-player-fe.git
```

Navigate to the front end directory

```
cd music-player-fe
```

Go to the correct story on the front end

```
git checkout story-8
```

Run the installer and start

```
npm install
```
```
npm start
```
# Documentation

**Return all artists**
* **URL**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/artists.php

* **Method:**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;GET

* **URL Params**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;**Required:**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;There are no required URL params

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;**Optional:**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;There are no optional URL params

* **Success Response:**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Code: 200  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Content:  
```
{
  "artists": [
    {
      "name": "Billie Eilish",
      "albums": [
        {
          "name": "When We All Fall Asleep, Where Do We Go?",
          "songs": [
            "bad guy",
            "bury a friend",
            "you should see me in a crown"
          ],
          "artwork_url": "https://via.placeholder.com/400x400/386641/6A994E?text=The+Memory+of+Trees"
        },
        {
          "name": "Happier Than Ever",
          "songs": [
            "NDA",
            "Therefore I Am",
            "Happier Than Ever"
          ],
          "artwork_url": "https://via.placeholder.com/400x400/386641/6A994E?text=The+Memory+of+Trees"
        }
      ]
    }
  ]
}
```
* **Error Response**:  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Code: 500 SERVER ERROR  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Content: `{"message":"Unexpected error"}`  

**Return specific artist**
* **URL**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/artist.php

* **Method:**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;GET

* **URL Params**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;**Required:**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;name=string

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;**Optional:**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;There are no optional URL params

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;**Example:**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`/artist.php?name=Billie Eilish`

* **Success Response:**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Code: 200  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Content:  

```
{
  "name": "Billie Eilish",
  "albums": [
    {
      "name": "When We All Fall Asleep, Where Do We Go?",
      "songs": [
        {
          "name": "bad guy",
          "length": "3:28",
          "play_count": 2,
          "is_fav": true
        },
        {
          "name": "bury a friend",
          "length": "3:28",
          "play_count": 24,
          "is_fav": false
        },
        {
          "name": "you should see me in a crown",
          "length": "3:28",
          "play_count": 7,
          "is_fav": false
        }
      ],
      "artwork_url": "https://via.placeholder.com/400x400/386641/6A994E?text=The+Memory+of+Trees"
    }
  ]
}
```
* **Error Response**:
  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Code: 400 BAD REQUEST  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Content: `{"message":"Unknown artist name"}`

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Code: 500 SERVER ERROR  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Content: `{"message":"Unexpected error"}` 

**Return popular albums**
* **URL**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/popularAlbums.php

* **Method:**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;GET

* **URL Params**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;**Required:**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;There are no required URL params

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;**Optional:**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;There are no optional URL params

* **Success Response:**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Code: 200  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Content:  
```
[
  {
    "artist": "Billie Eilish",
    "name": "When We All Fall Asleep, Where Do We Go?",
    "songs": [
      "bad guy",
      "bury a friend",
      "you should see me in a crown"
    ],
    "artwork_url": "https://via.placeholder.com/50x50/386641/6A994E?text=The+Memory+of+Trees"
  }    ,
  {
    "artist": "Taylor Swift",
    "name": "Lover",
    "songs": [
      "ME!",
      "You Need To Calm Down",
      "Lover"
    ],
    "artwork_url": "https://via.placeholder.com/50x50/386641/6A994E?text=The+Memory+of+Trees"
  },
  {
    "artist": "Ed Sheeran",
    "name": "÷",
    "songs": [
      "Shape of You",
      "Castle on the Hill",
      "Galway Girl"
    ],
    "artwork_url": "https://via.placeholder.com/50x50/386641/6A994E?text=The+Memory+of+Trees"
  }
]
```
* **Error Response**:  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Code: 500 SERVER ERROR  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Content: `{"message":"Unexpected error"}`

**Mark a song as recently played**
* **URL**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/songPlayed.php

* **Method:**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;POST

* **URL Params**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;**Required:**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;There are no required URL params

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;**Optional:**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;There are no optional URL params

* **Body Data**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Must be sent as JSON with the correct headers

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;**Required:**
```
{
  "name": "String",
  "artist": "String"
}
```

* **Success Response:**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Code: 201 CREATED     
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Content: 
```
{"message": "Successfully recorded play."}
```

* **Error Response**:  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Code: 400 BAD REQUEST  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Content: `{"message":"Invalid song data", "data": []}`  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Code: 500 SERVER ERROR    
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Content: `{"message":"Unexpected error", "data":[]}`

**Return recently played songs**
* **URL**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/recentSongs.php

* **Method:**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;GET

* **URL Params**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;**Required:**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;There are no required URL params

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;**Optional:**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;There are no optional URL params

* **Success Response:**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Code: 200  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Content: 
```
[
  {
    "name": "Song title 1",
    "artist": "Artist 1",
    "length": "3:28",
    "artwork_url": "https://via.placeholder.com/400x400/386641/6A994E?text=The+Memory+of+Trees",
    "is_fav": false
  },
  {
    "name": "Song title 2",
    "artist": "Artist 2",
    "length": "3:28",
    "artwork_url": "https://via.placeholder.com/400x400/386641/6A994E?text=The+Memory+of+Trees",
    "is_fav": false
  },
  {
    "name": "Song title 3",
    "artist": "Artist 3",
    "length": "3:28",
    "artwork_url": "https://via.placeholder.com/400x400/386641/6A994E?text=The+Memory+of+Trees",
    "is_fav": true
  }
]
```
* **Error Response**:  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Code: 500 SERVER ERROR  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Content: `{"message":"Unexpected error"}`

**Mark a song as favourite**
* **URL**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/favourite.php

* **Method:**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;POST

* **URL Params**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;**Required:**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;There are no required URL params

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;**Optional:**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;There are no optional URL params

* **Body Data**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Must be sent as JSON with the correct headers  

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;**Required:**  
```
{
  "name": "String", // name of the song
  "artist": "String" // name of the artist to prevent duplicate song names
}
```

* **Success Response:**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Code: 202 ACCEPTED  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Content: 
```
{"message": "Successfully favourited song."}
```
OR
```
{"message": "Successfully unfavourited song."}
```

* **Error Response**:  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Code: 400 BAD REQUEST  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Content: `{"message":"Invalid song data", "data": []}`  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Code: 500 SERVER ERROR    
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Content: `{"message":"Unexpected error", "data":[]}`

**Search for a song by song name**
* **URL**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/search.php

* **Method:**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;GET

* **URL Params**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;**Required:**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`name=string`

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;**Optional:**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;There are no optional URL params

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;**Example:**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`search.php?name=love`

* **Success Response:**

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Code: 200  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Content: 
```
[
{
  "name": "Song title 1",
  "artist": "Artist 1",
  "length": "3:28",
  "artwork_url": "https://via.placeholder.com/400x400/386641/6A994E?text=The+Memory+of+Trees",
  "play_count": 5,
  "is_fav": false
},
{
  "name": "Song title 2",
  "artist": "Artist 2",
  "length": "3:28",
  "artwork_url": "https://via.placeholder.com/400x400/386641/6A994E?text=The+Memory+of+Trees",
  "play_count": 5,
  "is_fav": false
},
{
  "name": "Song title 3",
  "artist": "Artist 3",
  "length": "3:28",
  "artwork_url": "https://via.placeholder.com/400x400/386641/6A994E?text=The+Memory+of+Trees",
  "play_count": 5,
  "is_fav": true
}
]
```
* **Error Response**:  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Code: 400 BAD REQUEST  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Content: `{"message":"Invalid song data", "data": []}`  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Code: 500 SERVER ERROR    
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Content: `{"message":"Unexpected error", "data":[]}`

# Authors

John Harrison - [@JBHarrison5](https://github.com/JBHarrison5)  
Richard Gabb - [@richardjgabb](https://github.com/richardjgabb)  
Max Hamilton - [@maxeh987](https://github.com/maxeh987)  
Liz Hartley - [@elizabeth-hartley](https://github.com/elizabeth-hartley)  
Izayah Jordan - [@2naCan](https://github.com/2naCan)  
Sara Berggren - [@AnnaSaraBerggren](https://github.com/AnnaSaraBerggren)  

# Links
Live API - [LINK](https://2024-johnh.dev.io-academy.uk/music-player-api/)  
Live Site - [LINK](https://2024-johnh.dev.io-academy.uk/music-player-fe/)
