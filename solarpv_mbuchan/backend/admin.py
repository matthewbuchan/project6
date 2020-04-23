from django.contrib import admin

from .models import TestSequence, Product, Client, TestStandard, Location, User, Certificate, Service, PerformanceData

# Register your models here.

admin.site.register(TestSequence)
admin.site.register(Product)
admin.site.register(Client)
admin.site.register(TestStandard)
admin.site.register(Location)
admin.site.register(User)
admin.site.register(Certificate)
admin.site.register(Service)
admin.site.register(PerformanceData)
