from django import forms


class LogForm(forms.Form):

    username = forms.CharField(max_length=100)
    password = forms.CharField(widget=forms.PasswordInput)
