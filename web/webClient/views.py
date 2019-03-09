import requests
import json

from django.shortcuts import render, redirect
from django.http import HttpResponseRedirect, JsonResponse
from django.views.decorators.csrf import csrf_exempt
from django.contrib.auth import login, authenticate, logout
from django.contrib.auth.models import User
from django.contrib.auth.forms import UserCreationForm
from django.contrib.auth.decorators import login_required
from django.http import HttpResponse, Http404
import requests
import json
import os
import base64

from .forms import LogForm

from allauth.socialaccount.models import SocialToken

#NO_PROXY = {
#    'no': 'pass',
#}

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
            username = form.cleaned_data.get('username')
            raw_password = form.cleaned_data.get('password1')
            url = "http://area_server/user"
            response = requests.post(url, data = {'login':username, 'pass':raw_password})
            content = response.text
            print(content)
            content = content.replace("{", "").replace("}", "").replace("\n", "")
            content = content.split(",")
            status = content[0].split(":")[1].replace("\"", "").replace(" ", "")
            print(status)
            if status in ["ok"]:
                form.save()
                token = content[2].split(":")[1].replace("\"", "")
                print(token)
                user = authenticate(username=username, password=raw_password)
                user.first_name = token
                user.save()
                login(request, user)
                return redirect('home')
            # Recup token + mettre en BDD
        else:
            print("Fail")
    else:
        form = UserCreationForm()
    return render(request, 'webClient/signup.html', {'form': form})

def loginview(request):
    form = LogForm(request.POST or None)
    if form.is_valid():
        # Ici nous pouvons traiter les données du formulaire
        username = form.cleaned_data['username']
        password = form.cleaned_data['password']
        url = "http://area_server/user?login=" + username + "&pass=" + password
#        url = "http://localhost:8080/user?login=" + username + "&pass=" + password
        response = requests.get(url)
        content = response.text
        print(content)
        content = content.replace("{", "").replace("}", "").replace("\n", "")
        content = content.split(",")
        status = content[0].split(":")[1].replace("\"", "").replace(" ", "")
        print(status)
        if status in ["ok"]:
            token = content[2].split(":")[1].replace("\"", "")
            print(token)
            user = authenticate(username=username, password=password)
            if user is not None:
                user.first_name = token
                user.save()
                login(request, user)
            else:
                user = User.objects.create_user(username, 'nomailattributed@nomail.com', password)
                user = authenticate(username=username, password=password)
                user.first_name = token
                user.save()
                login(request, user)
            return redirect('home')
            # Recup token + mettre en BDD
        else:
            print(content)
    return render(request, 'webClient/login.html', locals())

@login_required
def profile(request):
    user = request.user
    github = SocialToken.objects.filter(account__user=user, account__provider='github')
    twitter = SocialToken.objects.filter(account__user=user, account__provider='twitter')
    if twitter:
        twitter = SocialToken.objects.get(account__user=user, account__provider='twitter')

    form = LogForm(request.POST or None)
    if form.is_valid():
        # Ici nous pouvons traiter les données du formulaire
        username = form.cleaned_data['username']
        password = form.cleaned_data['password']
        url = "http://area_server/user?login=" + username + "&pass=" + password
#        url = "http://localhost:8080/user?login=" + username + "&pass=" + password
        response = requests.get(url)
        content = response.text
        print("Content :" + content)
        content = content.replace("{", "").replace("}", "").replace("\n", "")
        content = content.split(",")
        status = content[0].split(":")[1].replace("\"", "").replace(" ", "")
        print(status)
        if status in ["ok"]:
            token = content[2].split(":")[1].replace("\"", "")
            user = authenticate(username=username, password=password)
            if user is not None:
                user.first_name = token
                user.save()
                login(request, user)
            else:
                user = User.objects.create_user(username, 'nomailattributed@nomail.com', password)
                user = authenticate(username=username, password=password)
                user.first_name = token
                user.save()
                login(request, user)

                ##

            url = "http://area_server/token"
            auth_token = user.first_name.replace(" ", "")
            if github:
                github = github[0]
                response = requests.post(url, headers={"Authorization": auth_token}, data = {'service':'github', 'service_token': github})
                print("RESPONSE :", response.text)
            if twitter:
                response = requests.post(url, headers={"Authorization": auth_token}, data = {'service':'twitter', 'service_token': twitter.token, 'service_token_secret': twitter.token_secret})
                print("RESPONSE :", response.text)

                ##
            return redirect('home')
            # Recup token + mettre en BDD
        else:
            print(content)
    return render(request, 'webClient/profile.html', locals())

@login_required
def connexion(request):
    return render(request, 'webClient/connexion.html', locals())

@login_required
@csrf_exempt
def imgur(request):
       # recuperation de la liste des bouteille
    if request.method == 'POST':
        user = request.user
        auth_token = user.first_name.replace(' ', '')
        # no need to do this
        # request_csrf_token = request.POST.get('csrfmiddlewaretoken', '')
        datas = request.POST.get('token_list', None)
        # make sure that you serialise "request_getdata"
        datas = datas.replace("\"", "").replace("{", "").replace("}", "").split(",")
        access_token = datas[0].split(':')[1]
        refresh_token = datas[1].split(':')[1]
        url = "http://area_server/token"
        response = requests.post(url, headers={'Authorization': auth_token}, data = {'service':'imgur', 'service_token': access_token, 'service_token_secret': refresh_token})
        print(response.text)
    return render(request, 'webClient/imgur.html', locals())

@login_required
@csrf_exempt
def trello(request):
       # recuperation de la liste des bouteille
    if request.method == 'POST':
        user = request.user
        auth_token = user.first_name.replace(' ', '')
        # no need to do this
        # request_csrf_token = request.POST.get('csrfmiddlewaretoken', '')
        datas = request.POST.get('token_list', None)
        # make sure that you serialise "request_getdata"
        datas = datas.replace("\"", "").replace("{", "").replace("}", "").split(",")
        access_token = datas[0].split(':')[1]
        url = "http://area_server/token"
        response = requests.post(url, headers={'Authorization': auth_token}, data = {'service':'trello', 'service_token': access_token})
        print(response.text)
    return render(request, 'webClient/trello.html', locals())

@login_required
@csrf_exempt
def services(request):
    if request.method == 'POST':
        user = request.user
        auth_token = user.first_name.replace(' ', '')
        actionParams = '';
        reactionParams = '';
        for i in range(0, 1000):
            currParam = request.POST.get('action_param_' + str(i), None)
            if currParam == None:
                break
            if i != 0:
                actionParams += ";";
            actionParams += base64.b64encode(currParam.encode('utf-8')).decode("'utf-8")
        for i in range(0, 1000):
            currParam = request.POST.get('reaction_param_' + str(i), None)
            if currParam == None:
                break
            if i != 0:
                reactionParams += ";";
            reactionParams += base64.b64encode(currParam.encode('utf-8')).decode("utf-8")

        url = "http://area_server/trigger"
        response = requests.post(url, headers={'Authorization': auth_token}, data = {'action_service':request.POST.get('action_service', ''), 'reaction_service': request.POST.get('reaction_service', ''), 'action': request.POST.get('action', ''),  'reaction': request.POST.get('reaction', ''), 'action_params': actionParams, 'reaction_params': reactionParams})
        print(response.text)
    servicesJSON = requests.get("http://area_server/about.json").text
    return render(request, 'webClient/services.html', locals())

def clientapk(request):
    if (os.path.exists("/shared_folder/area.apk") == False):
        raise Http404
    with open("/shared_folder/area.apk", 'rb') as fh:
        response = HttpResponse(fh.read(), content_type="application/vnd.android.package-archive")
        response['Content-Disposition'] = 'inline; filename=client.apk'
        return response
