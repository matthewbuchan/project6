from django.shortcuts import render
from rest_framework import viewsets, generics
from .models import TestSequence, Product, Client, TestStandard, Location, User, Certificate, Service, PerformanceData
from .serializers import TestSequenceSerializer,ProductSerializer,ClientSerializer,TestStandardSerializer,LocationSerializer,UserSerializer,CertificateSerializer,ServiceSerializer,PerformanceDataSerializer

class TestSequenceView(viewsets.ModelViewSet):
    queryset = TestSequence.objects.all()
    serializer_class = TestSequenceSerializer

class ProductView(viewsets.ModelViewSet):
    queryset = Product.objects.all()
    serializer_class = ProductSerializer

class ClientView(viewsets.ModelViewSet):
    queryset = Client.objects.all()
    serializer_class = ClientSerializer

class TestStandardView(viewsets.ModelViewSet):
    queryset = TestStandard.objects.all()
    serializer_class = TestStandardSerializer

class LocationView(viewsets.ModelViewSet):
    queryset = Location.objects.all()
    serializer_class = LocationSerializer

class UserView(viewsets.ModelViewSet):
    queryset = User.objects.all()
    serializer_class = UserSerializer

class CertificateView(viewsets.ModelViewSet):
    queryset = Certificate.objects.all()
    serializer_class = CertificateSerializer                       

class ServiceView(viewsets.ModelViewSet):
    queryset = Service.objects.all()
    serializer_class = ServiceSerializer

class PerformanceDataView(viewsets.ModelViewSet):
    queryset = PerformanceData.objects.all()
    serializer_class = PerformanceDataSerializer
