
from django.conf.urls import url
from . import views


urlpatterns = [
    url('home', views.home, name='home'),
    url('login', views.loginview, name='login'),
    url('signup', views.signup, name='signup'),
    url('profile', views.profile, name='profile'),
    url('imgur', views.imgur),
    url('services', views.services),
    url('connexion', views.connexion)
]
