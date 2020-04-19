from django.shortcuts import render
from rest_framework import viewsets, generics
from .models import Product, Certificate, Service
from .serializers import ProductSerializer, CertificateSerializer, ServiceSerializer

class ProductView(viewsets.ModelViewSet):
    queryset = Product.objects.all()
    serializer_class = ProductSerializer

class CertificateView(viewsets.ModelViewSet):
    queryset = Certificate.objects.all()
    serializer_class = CertificateSerializer                       

class ServiceView(viewsets.ModelViewSet):
    queryset = Service.objects.all()
    serializer_class = ServiceSerializer