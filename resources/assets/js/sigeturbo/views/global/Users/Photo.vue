<template>
    <section class="sige-users-photo">
        <img :id="'user_photo_'+user" :src="assets + '/img/users/' + photo"
             :alt="fullname"
             :title="fullname">
        <section class="change-photo" @click="togglePhotoForm()">{{ $translate.text('sigeturbo.change') | uppercase }}
        </section>
        <section v-show="togglePhoto" class="sige-main-modal" style="display: block;padding-top: 100px">
            <section class="modal-content" style="width: 700px">
                <div class="close" @click="closePhotoForm()">
                    <i class="fas fa-window-close fa-lg"></i>
                </div>
                <section class="sige-wizard-container padding-30">
                    <header>
                        <h4>{{ $translate.text('sigeturbo.change_photo') | uppercase }}</h4>
                    </header>
                    <section class="body">
                        <form @submit="uploadPhoto($event)">
                            <fieldset class="welcome" id="step-0" data-step="0">
                                <legend>Welcome</legend>
                                <ul class="display-horizontal col-100">
                                    <li>
                                        <img :src='assets+ "/img/modules/profile_info_general_welcome1.svg"' alt=""/>
                                    </li>
                                    <li class="col-100">
                                        <input @click="setStep(1)" class="btn btn-aquamarine" type="button"
                                               :value="$translate.text('sigeturbo.start') | capitalize">
                                    </li>
                                </ul>
                            </fieldset>
                            <fieldset class="step" id="step-1" data-step="1">
                                <legend>{{ $translate.text('sigeturbo.step') | uppercase }} 1</legend>
                                <ul class="display-horizontal col-100">
                                    <li class="col-100 gutter-5">
                                        <input type="file" name="image" accept="image/*"
                                               style="font-size: 1.2em; padding: 10px 0;"
                                               @change="setImage"/>
                                    </li>
                                </ul>
                            </fieldset>
                            <fieldset class="step" id="step-2" data-step="2">
                                <legend>{{ $translate.text('sigeturbo.step') | uppercase }} 2</legend>
                                <ul class="display-horizontal col-100">
                                    <li class="col-100 gutter-5">
                                        <section class="sige-photo-upload-container">
                                            <ul class="display-horizontal col-100">
                                                <li class="col-60 upload gutter-10">
                                                    <ul class="display-horizontal col-100">
                                                        <li class="col-100">
                                                            <sigeturbo-cropper
                                                                    ref='cropper'
                                                                    :guides="true"
                                                                    :view-mode="2"
                                                                    drag-mode="crop"
                                                                    preview=".preview"
                                                                    :auto-crop-area="0.5"
                                                                    :min-container-width=355
                                                                    :min-container-height=240
                                                                    :background="true"
                                                                    :rotatable="true"
                                                                    src=""
                                                                    :alt="fullname"
                                                                    :img-style="{ 'width': '400px', 'height': '400px' }">
                                                            </sigeturbo-cropper>
                                                        </li>
                                                        <li class="col-50">
                                                            <button class="btn btn-blue margin-top-05"
                                                                    style="margin:5px auto"
                                                                    @click="cropImage"
                                                                    v-if="imgSrc != ''">Crop
                                                            </button>
                                                        </li>
                                                        <li class="col-50">
                                                            <button class="btn btn-blue margin-top-05"
                                                                    style="margin:5px auto"
                                                                    @click="rotate"
                                                                    v-if="imgSrc != ''">Rotate
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="col-40 crop-preview gutter-10">
                                                    <div class="preview"></div>
                                                    <template v-if="cropImg != ''">
                                                        <ul class="display-horizontal col-100">
                                                            <li class="col-100">
                                                                <img :src="cropImg"
                                                                     style="width: 180px; height: 180px; border: 1px solid gray"
                                                                     alt="Cropped Image"/>
                                                            </li>
                                                            <li class="col-100">
                                                                <button class="btn btn-green margin-top-05"
                                                                        type="button"
                                                                        @click="uploadPhoto"
                                                                        v-if="cropImg != ''">
                                                                    Upload
                                                                </button>
                                                            </li>
                                                        </ul>
                                                    </template>
                                                </li>
                                            </ul>
                                        </section>
                                    </li>
                                </ul>
                            </fieldset>
                        </form>
                    </section>
                    <footer>
                        <ul class="display-horizontal col-100">
                            <li class="col-35 previous"></li>
                            <li class="col-30 steps">
                                <ul class="display-horizontal col-100">
                                    <li @click="setStep(1)">
                                        <div :class="[stepSelected == 1 ? 'selected' : '']">1</div>
                                    </li>
                                    <li @click="setStep(2)">
                                        <div :class="[stepSelected == 2 ? 'selected' : '']">2</div>
                                    </li>
                                </ul>
                            </li>
                            <li class="col-35 next"></li>
                        </ul>
                    </footer>
                </section>
            </section>
        </section>
    </section>
</template>
<script>

    import {assets} from "../../../core/utils";
    import uppercase from "../../../filters/string/uppercase";
    import SigeturboCropper from '../../../plugins/Cropper';
    import capitalize from "../../../filters/string/capitalize";
    import Upload from "../../../models/Upload";

    export default {

        props: [
            'user',
            'photo',
            'fullname',
        ],
        filters: {
            uppercase: uppercase,
            capitalize: capitalize,
        },
        components: {
            SigeturboCropper
        },
        data: function () {
            return {
                assets: assets(),
                togglePhoto: false,
                steps: 2,
                stepSelected: 0,
                imgSrc: '',
                cropImg: '',
                extension: 'jpg',
                type: 'image/jpeg',
            }
        },
        methods: {
            togglePhotoForm() {
                this.togglePhoto = true;
            },
            closePhotoForm() {
                this.togglePhoto = false;
            },
            setImage(event) {
                const file = event.target.files[0];
                this.extension = event.target.files[0].name.split('.').pop().toLowerCase();
                this.type = event.target.files[0].type;
                if (!file.type.includes('image/')) {
                    alert('Please select an image file');
                    return;
                }
                if (typeof FileReader === 'function') {
                    const reader = new FileReader();
                    reader.onload = (event) => {
                        this.imgSrc = event.target.result;
                        this.$refs.cropper.replace(event.target.result);
                    };
                    reader.readAsDataURL(file);
                } else {
                    alert('Sorry, FileReader API not supported');
                }
            },
            cropImage(event) {
                event.preventDefault();
                // get image data for post processing, e.g. upload or setting image src
                this.cropImg = this.$refs.cropper.getCroppedCanvas().toDataURL();
            },
            rotate(event) {
                event.preventDefault();
                // guess what this does :)
                this.$refs.cropper.rotate(90);
            },
            uploadPhoto() {
                this.$refs.cropper.getCroppedCanvas().toBlob((blob) => {
                    const formData = new FormData();
                    blob.lastModifiedDate = new Date();
                    blob.name = this.user + '.' + this.extension;
                    formData.append('photo', blob, this.user + '.' + this.extension);
                    formData.append('user', this.user);

                    //Upload Photo
                    Upload.uploadUserPhoto(formData).then(({data}) => {
                        console.log(data);
                    }).catch(error => console.log(error));

                }, this.type);
            },
            setStep(step) {
                for (let i = 0; i <= this.steps; i++) {
                    document.getElementById('step-' + i).style.display = "none";
                }
                document.getElementById('step-' + step).style.display = "block";
                //Step Selected
                this.stepSelected = step;
            },
        },
        watch: {},
        created() {
        },
        mounted() {
        },
    }

</script>