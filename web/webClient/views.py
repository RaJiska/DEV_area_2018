from django.shortcuts import render, redirect
from django.http import HttpResponseRedirect
from .forms import LogForm
from django.views.decorators.csrf import csrf_exempt
from allauth.socialaccount.models import SocialToken
from django.contrib.auth.models import User
from django.http import JsonResponse
from django.contrib.auth import login, authenticate
from django.contrib.auth.forms import UserCreationForm


def username_present(username):
    if User.objects.filter(username=username).exists():
        return True
    return False


def home(request):
    return render(request, 'webClient/home.html', locals())


def signup(request):
    if request.method == 'POST':
        form = UserCreationForm(request.POST)
        if form.is_valid():
            form.save()
            username = form.cleaned_data.get('username')
            raw_password = form.cleaned_data.get('password1')
            user = authenticate(username=username, password=raw_password)
            login(request, user)
            return redirect('home')
    else:
        form = UserCreationForm()
    return render(request, 'webClient/signup.html', {'form': form})

def loginview(request):
    form = LogForm(request.POST or None)
    if form.is_valid():
        # Ici nous pouvons traiter les données du formulaire
        username = form.cleaned_data['username']
        password = form.cleaned_data['password']
        print(username)
        print(password)
        if (username_present(username)):
            print("PRESENT !")
            print("Login !")
            # Recup token + mettre en BDD
        else:
            print("NOT PRESENT")
            print("Go to registration")

    return render(request, 'webClient/login.html', locals())

def profile(request):
    user = None
    if request.user.is_authenticated():
        user = request.user
    github = SocialToken.objects.filter(account__user=user, account__provider='github')
    instagram = SocialToken.objects.filter(account__user=user, account__provider='instagram')
    twitter = SocialToken.objects.filter(account__user=user, account__provider='twitter')
    facebook = SocialToken.objects.filter(account__user=user, account__provider='facebook')
    return render(request, 'webClient/profile.html', locals())

def connexion(request):

    return render(request, 'webClient/connexion.html', locals())

@csrf_exempt
def imgur(request):
       # recuperation de la liste des bouteille
    if request.method == 'POST':
        # no need to do this
        # request_csrf_token = request.POST.get('csrfmiddlewaretoken', '')
        datas = request.POST.get('token_list', None)
        # make sure that you serialise "request_getdata"
        datas = datas.replace("\"", "").replace("{", "").replace("}", "").split(",")
        access_token = datas[0].split(':')[1]
        refresh_token = datas[1].split(':')[1]
        print(refresh_token)

    return render(request, 'webClient/imgur.html', locals())


def services(request):
    return render(request, 'webClient/services.html', locals())
