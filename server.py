from flask import Flask, jsonify, render_template, request, Response
from jinja2 import Environment, PackageLoader
from urllib import urlopen
from bs4 import BeautifulSoup
import json, socket, urllib2

app = Flask(__name__)
env = Environment(loader=PackageLoader('server', 'templates'))

@app.route("/")
def hello():
	u=urlopen('http://www.mtcbus.org/Routes.asp?cboRouteCode='+bus)
	soup = BeautifulSoup(str(u.read()))
	out = [x.find('span').string for x in soup.body.div.ul.find_all('li')]
	return out

if __name__ == "__main__":
	app.run(debug='true')
