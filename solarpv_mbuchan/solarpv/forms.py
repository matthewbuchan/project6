from django.forms import ModelForm
from .models import User,Certificate
    
from django import forms


class RegisterForm(ModelForm):
    class Meta:
        model = User
        fields = '__all__'

class LoginForm(ModelForm):
    class Meta:
        model = User
        fields = ['username']
    
class CertificateForm(ModelForm):

    class Meta:
        model = Certificate
        fields = '__all__'