from rest_framework import serializers
from .models import TestSequence, Product, Client, TestStandard, Location, User, Certificate, Service, PerformanceData

class TestSequenceSerializer(serializers.ModelSerializer):

    class Meta:
        model = TestSequence
        fields = ['sequenceid', 'sequencename']
    
class ProductSerializer(serializers.ModelSerializer):

    class Meta:
        model = Product
        fields = ['modelnumber', 'productname', 'celltechnology', 'numberofcells','numberofcellsinseries','numberofseriesinstrings','numberofdiodes','productlength','productwidth','productweight','superstatetype','superstatemanufacturer','substratetype','substratemanufacturer','frametype','frameadhesive','encapsulatetype','encapsulatemanufacturer','junctionboxtype','junctionboxmanufacturer']
    
class ClientSerializer(serializers.ModelSerializer):

    class Meta:
        model = Client
        fields = ['clientname', 'clienttype']
    
class TestStandardSerializer(serializers.ModelSerializer):

    class Meta:
        model = TestStandard
        fields = ['standardname', 'description', 'publisheddate']
    
class LocationSerializer(serializers.ModelSerializer):

    class Meta:
        model = Location
        fields = ['address1','address2','city','state','postalcode','country','phonenumber','faxnumber','clientid']

class UserSerializer(serializers.ModelSerializer):

    class Meta:
        model = User
        fields = ['firstname','lastname','middlename','jobtitle','email','officephone','cellphone','username','appellation','clientid']
        

class CertificateSerializer(serializers.ModelSerializer):

    class Meta:
        model = Certificate        
        fields = ['userid','reportnumber','issuedate','standardid','locationid','modelnumber']


class ServiceSerializer(serializers.ModelSerializer):

    class Meta:
        model = Service
        fields = ['servicename','description','isfirequired','fifrequency','standardid']

class PerformanceDataSerializer(serializers.ModelSerializer):

    class Meta:
        model = PerformanceData
        fields = ['modelnumber','sequenceid','maxsystemvoltage','voc','isc','vmp','imp','pmp','ff']

