from django.shortcuts import render


def home(request):
    return render(request, 'webClient/home.html', locals())


def login(request):
    return render(request, 'webClient/login.html', locals())

def profile(request):
    return render(request, 'webClient/profile.html', locals())

def connexion(request):
    return render(request, 'webClient/connexion.html', locals())

def services(request):
    return render(request, 'webClient/services.html', locals())
