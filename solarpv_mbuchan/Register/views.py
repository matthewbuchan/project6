# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.shortcuts import render
from django.shortcuts import HttpResponse

# Create your views here.
def Register(request):
    return HttpResponse("<H1>Hi there REGISTRATION</H1>")
