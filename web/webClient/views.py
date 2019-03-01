from django.shortcuts import render
from .forms import LogForm
from allauth.socialaccount.models import SocialToken
from django.contrib.auth.models import User

def username_present(username):
    if User.objects.filter(username=username).exists():
        return True
    return False


def home(request):
    return render(request, 'webClient/home.html', locals())


def login(request):
    form = LogForm(request.POST or None)

    # Nous vérifions que les données envoyées sont valides

    # Cette méthode renvoie False s'il n'y a pas de données

    # dans le formulaire ou qu'il contient des erreurs.

    if form.is_valid():
        # Ici nous pouvons traiter les données du formulaire
        username = form.cleaned_data['username']
        password = form.cleaned_data['password']
        print(username)
        print(password)
        if (username_present(username)):
            print("PRESENT !")
            print("Login !")
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

def services(request):
    return render(request, 'webClient/services.html', locals())
