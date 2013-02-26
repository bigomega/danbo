from flask import Flask, jsonify, render_template, request, Response
from jinja2 import Environment, PackageLoader
from urllib import urlopen
from bs4 import BeautifulSoup
import json, socket, urllib2, re

app = Flask(__name__)
env = Environment(loader=PackageLoader('server', 'templates'))

@app.route("/")
def index():
	return "<center><br><br><br>\
	<input type='text' id='key' placeholder='enter key word'/><br><br>\
	<button onclick='window.location=\"/wiki?key=\"+document.getElementById(\"key\").value'>Generate</button>"

@app.route("/wiki")
def hello():
	string=""
	key=request.args.get('key','',type=str)
	key=key or "java"
	u=urlopen('http://search.carrot2.org/stable/search?query='+key+'&results=100&source=web&algorithm=lingo&view=folders&skin=fancy-compact&EToolsDocumentSource.language=ALL&EToolsDocumentSource.country=ALL&EToolsDocumentSource.safeSearch=false&type=CLUSTERS&_=1361291851804')
	soup = BeautifulSoup(str(u.read()))
	words = [x.find('span').string for x in soup.body.div.ul.find_all('li')]
	# for word in words:
	# 	string+=local(word)
	temp="<center><h2>"+key+"</h2><ul>"
	for word in words:
		temp+="<li>"+word+"</li>"
	return temp

@app.route("/test")
def test():
	u=urlopen('http://search.carrot2.org/stable/search?query=java&results=100&source=web&algorithm=lingo&view=folders&skin=fancy-compact&EToolsDocumentSource.language=ALL&EToolsDocumentSource.country=ALL&EToolsDocumentSource.safeSearch=false&type=CLUSTERS&_=1361291851804')
	soup = BeautifulSoup(str(u.read()))
	words = [x.find('span').string for x in soup.body.div.ul.find_all('li')]
	# for word in words:
	# 	string+=local(word)
	return str(words)

def local(key):
	import sys
	import time
	import urllib, urllib2
	import xml.etree.cElementTree as etree
	#
	title = key or "data_mining"
	# prepare request
	maxattempts = 5 # how many times to try the request before giving up
	maxlag = 5 # seconds http://www.mediawiki.org/wiki/Manual:Maxlag_parameter
	params = dict(action="query", format="xml", maxlag=maxlag, prop="revisions", rvprop="content", rvsection=0, titles=title)
	request = urllib2.Request("http://en.wikipedia.org/w/api.php?" + urllib.urlencode(params), headers={"User-Agent": "WikiDownloader/1.2","Referer": "http://stackoverflow.com/"})
	# make request
	for _ in range(maxattempts):
		response = urllib2.urlopen(request)
		if response.headers.get('MediaWiki-API-Error') == 'maxlag':
			t = response.headers.get('Retry-After', 5)
			print "retrying in %s seconds" % (t,)
			time.sleep(float(t))
		else:
			break # ready to read
	else: # exhausted all attempts
		sys.exit(1)
	# download & parse xml 
	tree = etree.parse(response)
	#
	# find rev data 
	rev_data = tree.findtext('.//rev')
	if not rev_data:
		print 'MediaWiki-API-Error:', response.headers.get('MediaWiki-API-Error')
		tree.write(sys.stdout)
		print
		sys.exit(1)
	
	str(u[5]).split('|')[-1].replace(r'&nbsp',' ')
	return rev_data

if __name__ == "__main__":
	app.run(debug='true')
	key="chennai"|key
	data =local(key)
	links = re.findall(r'\[\[[^\]\]]*\]\]', data, re.M|re.I) #gets the links
	for link in links:
		link = re.findall(r'[^\[].*[^\]]', link, re.M|re.I)[0].split('|')[-1].replace(r'&nbsp',' ')
		print link