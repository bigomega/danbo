require 'sinatra'
require './spell.rb'

get '/' do
	"Danbo profile maintainence"
end

get '/spell' do
	"java"
end

get '/spell/' do
	"java"
end

get '/spell/:word' do
  correct(params[:word])
end