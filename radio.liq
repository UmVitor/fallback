#!/usr/bin/liquidsoap
#log dir

set("log.file.path","/tmp/basic-radio.log")

#Music
myplaylist = playlist(" ") #path of playlist, with format .m3u

#Jingles
jingles = single("") #path of the jingle

security = single("") #path of security song 

silence = single("") #path of the silence song, it works like a delay for song of fallback

radio = myplaylist

radio = random(weights=[1,4], [jingles , radio])

radio = fallback(track_sensitive = false , [radio,security])

full = fallback( track_sensitive = false , [input.http(" IP OF RADIO STATE FOR RETRANSMITE ") , sequence( merge=true , [silence, radio])])

output.icecast(%mp3, host="HOST OF STREAMING" , port=8000 , password="" , mount="radio", full)

output.icecast(%vorbis, host="HOST OF STREAMING" , port=8000 , password="" , mount="radio", full)

output.icecast(%mp3, host="localhost" , port=8000 , password="" , mount="radio", full)
