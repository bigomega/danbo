from flask import Flask, jsonify, render_template, request, Response
from jinja2 import Environment, PackageLoader
from urllib import urlopen
from bs4 import BeautifulSoup
import xml.etree.cElementTree as etree
import sys, time, json, socket, urllib2, re, requests, collections

app = Flask(__name__)
env = Environment(loader=PackageLoader('server', 'templates'))

@app.route("/")
def index():
	return "<center><br><br><br>\
	 <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js'></script>\
	 <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js'></script>\
	 <link href='http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css' rel='stylesheet'>\
	<input type='text' id='key' placeholder='enter key word'/><br><br>\
	<button class='btn' onclick='window.location=\"/wiki?key=\"+document.getElementById(\"key\").value'>Generate</button>"

@app.route("/wiki")
def wiki():
	try:
		key = request.args.get('key','',type=str) or "java"
		data = wikiData(key)
		if(type(data) is str and data == ""):
			return Response(json.dumps(["NO DATA"]), mimetype='application/json')
		data = data.encode('utf-8')
		parsedData = json.loads(requests.post("http://localhost:8888", data=data, proxies={'http':''}).text or "{'data': 'No Data'}")['data'].replace('\n','')
		sentences = splitParagraphIntoSentences(parsedData)
		return Response(json.dumps(sentences), mimetype='application/json')
	except:
		return Response(json.dumps(["NO DATA"]), mimetype='application/json')

@app.route("/keys")
def keys():
	try:
		key = request.args.get('key','',type=str) or "java"
		data = wikiData(key).encode('utf-8')
		links = []
		regExLinks = re.findall(r'\[\[[^\]\]|^\[\[]*\]\]', data, re.M|re.I) #gets the links
		# return str(regExLinks)
		for link in regExLinks:
			link = re.findall(r'[^\[^\]]+', link, re.M|re.I)[0].split('|')[-1].replace(r'&nbsp',' ')
			links.append(link)
		return Response(json.dumps(sorted(set(links))), mimetype='application/json')
	except:
		return Response(json.dumps(['']), mimetype='application/json')

# @app.route("/newUser", methods)

@app.route("/oauth", methods=['POST'])
def oauth():
	uname = str(request.form['user'])
	upass = str(request.form['pass'])
	db = json.loads(open('./db.json').read())
	return uname+upass+'---'

@app.route("/test")
def test():
	u=urlopen('http://search.carrot2.org/stable/search?query=java&results=100&source=web&algorithm=lingo&view=folders&skin=fancy-compact&EToolsDocumentSource.language=ALL&EToolsDocumentSource.country=ALL&EToolsDocumentSource.safeSearch=false&type=CLUSTERS&_=1361291851804')
	soup = BeautifulSoup(str(u.read()))
	words = [x.find('span').string for x in soup.body.div.ul.find_all('li')]
	# for word in words:
	# 	string+=local(word)
	return str(words)

def splitParagraphIntoSentences(paragraph):
	sentenceEnders = re.compile(r"""
			(?:               
			(?<=[.!?])      
			| (?<=[.!?]['"])  
			)                 
			(?<!  Mr\.   )    
			(?<!  Mrs\.  )   
			(?<!  Jr\.   )    
			(?<!  Dr\.   )    
			(?<!  Prof\. )    
			(?<!  Sr\.   )    
			(?<! B\.)
			\s+               
			""", 
		re.IGNORECASE | re.VERBOSE)
	sentenceList = sentenceEnders.split(paragraph)
	return sentenceList

def carrot2(key):
	u=urlopen('http://search.carrot2.org/stable/search?query='+key+'&results=100&source=web&algorithm=lingo&view=folders&skin=fancy-compact&EToolsDocumentSource.language=ALL&EToolsDocumentSource.country=ALL&EToolsDocumentSource.safeSearch=false&type=CLUSTERS&_=1361291851804')
	soup = BeautifulSoup(str(u.read()))
	words = [x.find('span').string for x in soup.body.div.ul.find_all('li')]
	# for word in words:
	# 	string+=local(word)
	temp="<center><h2>"+key+"</h2><ul>"
	for word in words:
		temp+="<li>"+word+"</li>"
	return temp

def wikiJSONData(key):
	key = key or "java"
	data = ""
	params = dict(action="query", format="json", maxlag=10, prop="revisions", rvprop="content", titles=title)
	request = urllib2.Request("http://en.wikipedia.org/w/api.php?" + urllib.urlencode(params), headers={"User-Agent": "WikiDownloader/1.2","Referer": "http://stackoverflow.com/"})
	response = urllib2.urlopen(request)
	jsonObject = json.loads(response)
	pages = jsonObject['query']['pages']
	for page in pages:
		data = page['revisions'][0]['contentmodel']
	return data

def wikiData(key):
	import urllib
	#
	title = key or "data_mining"
	# prepare request
	maxattempts = 5 # how many times to try the request before giving up
	maxlag = 5 # seconds http://www.mediawiki.org/wiki/Manual:Maxlag_parameter
	params = dict(action="query", format="xml", maxlag=maxlag, prop="revisions", rvprop="content", titles=title)
	request = urllib2.Request("http://en.wikipedia.org/w/api.php?" + urllib.urlencode(params), headers={"User-Agent": "WikiDownloader/1.2","Referer": ""})
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
		return ""
	# download & parse xml 
	tree = etree.parse(response)
	#
	# find rev data 
	rev_data = tree.findtext('.//rev')
	if not rev_data:
		print 'MediaWiki-API-Error:', response.headers.get('MediaWiki-API-Error')
		tree.write(sys.stdout)
		print
		return ""
	return rev_data

if __name__ == "__main__":
	app.run(debug='true')