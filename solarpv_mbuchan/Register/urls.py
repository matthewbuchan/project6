from django.conf.urls import url
from django.contrib import admin
from django.urls import path, include
from .views import Register

urlpatterns = [
    path('', Register, name = 'Register')
]
