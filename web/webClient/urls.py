
from django.conf.urls import url
from . import views


urlpatterns = [
    url('home', views.home),
    url('login', views.login),
    url('profile', views.profile),
    url('services', views.services),
    url('connexion', views.connexion),
]
